<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

//error_reporting(E_ALL);

$CFG = require_once("../common/include/incConfig.php");

require_once("../common/include/incDB.php");
require_once("../common/include/incSec.php");
require_once("../common/include/incUtil.php");
require_once("../common/include/incUser.php");
require_once("../common/include/incAuth.php");
require_once("../common/include/incRequest.php");

//guzzle clint를 통해 access_token에 대한 resource 정보 가져오기
require_once "../lib/php/vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

//마지막 로그인 세션id기록용
$objAuth= new authObject();	

//외부 파라미터 받기
$REQ["CLIENT_ID"] = reqPostString("client_id",100);
$REQ["access_token"] = reqPostString("access_token",100);
$REQ["refresh_token"] = reqPostString("refresh_token",100);


alog("REQ.access_token = ". $REQ["access_token"]);
alog("REQ.refresh_token = ". $REQ["refresh_token"]);

if($REQ["CLIENT_ID"] == ""){MsgBack("client_id 입력해 주세요.");}
if($REQ["access_token"] == ""){MsgBack("access_token 입력해 주세요.");}
if($REQ["refresh_token"] == ""){MsgBack("refresh_token 입력해 주세요.");}


//exit;

// Create a client with a base URI
$client = new GuzzleHttp\Client();
// Send a request to https://foo.com/api/test
//     'body' => 'grant_type=password&client_id=demoapp&client_secret=demopass&username=demouser&password=testpass'

$resJsonStr = "";
try{


    $fullUrl = "http://" . $CFG["CFG_OAUTH_HOST"] . ":" .  $CFG["CFG_OAUTH_PORT"] . "/o.s/os2ctl.php";
    //echo $fullUrl;

    $res = $client->request('GET',$fullUrl , [
        'timeout' => 1,
        'connect_timeout' => 1,
        'read_timeout' => 2,
        'query' => [
            'CTL' => "getResource"
            ,'access_token' => $REQ["access_token"]
        ]
    ]);

    
    //echo "<hr>" . $res->getStatusCode();
    // "200"
    //echo "<hr>" . $res->getHeader('content-type')[0];
    // 'application/json; charset=utf8'
    //echo "<hr>" . $res->getBody();

    //상태 코드 확인하기
    if(trim($res->getStatusCode()) != "200"){
        MsgBack("인증 정보를 요청 결과 오류가 발생했습니다.(rescode : " . $res->getStatusCode() . ")");
    }

    $resJsonStr = $res->getBody();
    $resArr = json_decode($resJsonStr,true);//true : stdclass가 아닌 그냥 배열로
    //var_dump($resArr);

}catch(ClientException $e) {
    alog("ClientException : " . $e->getMessage());
    //echo $e->getMessage() . "\n";
    //echo $e->getRequest()->getMethod();
}catch(GuzzleException $e) {
    alog("GuzzleException : " . $e->getMessage());
    //echo $e->getMessage() . "\n";
    //echo $e->getRequest()->getMethod();
}


//사용자 정보 세팅
$REQ["USR_SEQ"] = $resArr["RTN_DATA"]["USER_INFO"]["USR_SEQ"];
$REQ["USR_ID"] = $resArr["RTN_DATA"]["USER_INFO"]["USR_ID"];
$REQ["USR_NM"] = $resArr["RTN_DATA"]["USER_INFO"]["USR_NM"];
$REQ["TEAMCD"] = $resArr["RTN_DATA"]["USER_INFO"]["TEAMCD"];
$REQ["TEAMNM"] = $resArr["RTN_DATA"]["USER_INFO"]["TEAMNM"];


//마지막 로그인세션 기록용(중복로그인 방지)
$objAuth->setLastSession($REQ["USR_SEQ"] ,session_id());

//var_dump($arrAuth);
$objAuth->setUserAuth($resArr["RTN_DATA"]["AUTH_INFO"]);


//DB연결 정보 생성
$db = getDbConn($CFG["CFG_DB"]["RDCOMMON"]);

//인트로 URL가져오기
//$introUrl = getMyGrpIntroUrl();

//세션부여
//var_dump($REQ);
setUserSeq($REQ["USR_SEQ"]);
setUserId($REQ["USR_ID"]);
setUserNm($REQ["USR_NM"]);     
setTeamCd($REQ["TEAMCD"]);    
setTeamNm($REQ["TEAMNM"]);    
//setIntroUrl($introUrl);       

//oauth
setAccessToken($REQ["access_token"]);
setRefreshToken($REQ["refresh_token"]);

//log 기록
$REQ["SUCCESS_YN"] = "Y";
$REQ["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; 
$REQ["SERVER_NAME"] = $_SERVER["SERVER_NAME"]; 
$REQ["USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"]; 
$REQ["SESSION_ID"] = session_id(); 
$REQ["AUTH_JSON"] = json_encode($resArr["RTN_DATA"]["AUTH_INFO"]);
$REQ["RESPONSE_MSG"] = "ID EXIST, NO LOCK, PW EQUAL.";
/*
#{USR_ID}, #{SESSION_ID}, #{SUCCESS_YN}, #{RESPONSE_MSG}, #{LOCKCD}
, #{PW_ERR_CNT}, #{LOCK_LIMIT_DT},#{USR_SEQ}, #{SERVER_NAME}, #{REMOTE_ADDR}
, #{USER_AGENT}, #{AUTH_JSON}
*/
$LoginSeq = saveLoginLog($REQ);

//마지막 로그인로그 기록
setLoginSeq($LoginSeq);     

//객체 해제
closeDb($db);unset($objAuth);

//메인 페이지로 이동
//ob_start();
//header("Location : ./bo_main_v2.php")
?>
<script>
location = "bo_main_v3.php";
</script>
<?php

//ob_end_flush();
#print_r(headers_list());


function getMyGrpIntroUrl(){
    global $db,$REQ;
    $coltype = "i";
    $sql = "
        select c.PGMID, c.MNU_SEQ, c.MNU_NM, c.URL
        from CMN_GRP_USR a
            join CMN_GRP b on a.GRP_SEQ = b.GRP_SEQ
            join CMN_MNU c on b.INTRO_PGMID = c.PGMID
        where a.USR_SEQ = #{USR_SEQ}
    ";
    
    //$stmt = makeStmt($db,$sql,$coltype,$REQ);
    $objSqlParam = getSqlParam($sql,$coltype,$REQ);
    $stmt = getStmt($db,$objSqlParam);

    
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->errno . " -> " . $db->error);
    

    $tArr =  getStmtArray($stmt);
    $stmt->close();
    return $tArr;
}

function saveLoginLog($REQ){
    global $db, $_SERVER;


    $coltype = "sssss isiss sss";
    $sql = "
        insert into CMN_LOG_LOGIN ( 
            USR_ID, SESSION_ID, SUCCESS_YN, RESPONSE_MSG, LOCKCD
            , PW_ERR_CNT, LOCK_LIMIT_DT, USR_SEQ, SERVER_NAME, REMOTE_ADDR
            , USER_AGENT, AUTH_JSON, CLIENT_ID
            , ADD_DT
        ) values (
            #{USR_ID}, #{SESSION_ID}, #{SUCCESS_YN}, #{RESPONSE_MSG}, #{LOCKCD}
            , #{PW_ERR_CNT}, #{LOCK_LIMIT_DT},#{USR_SEQ}, #{SERVER_NAME}, #{REMOTE_ADDR}
            , #{USER_AGENT}, #{AUTH_JSON}, #{CLIENT_ID}
            , date_format(sysdate(),'%Y%m%d%H%i%s')
        ) 
    ";
    
    //$stmt = makeStmt($db,$sql,$coltype,$REQ);
    $objSqlParam = getSqlParam($sql,$coltype,$REQ);
    $stmt = getStmt($db,$objSqlParam);

    
    if(!$stmt)JsonMsg("500","301","SQL makeStmt 생성 실패 했습니다.");
    
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패 " .  $stmt->error);
    
    return  $db->insert_id;
}
?>