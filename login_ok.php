<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

session_start();

require_once("../c.g/include/incDB.php");
require_once("../c.g/include/incSEC.php");
require_once("../c.g/include/incUtil.php");
require_once("../c.g/include/incUser.php");
require_once("../c.g/include/incAuth.php");
require_once("../c.g/include/incRequest.php");
require_once("../c.g/incConfig.php");

//마지막 로그인 세션id기록용
$objAuth= new authObject();	

//외부 파라미터 받기
$REQ["F_EMAIL"] = reqPostString("F_EMAIL",100);
$REQ["F_PASSWD"] = reqPostString("F_PASSWD",30);


alog("REQ.F_EMAIL = ". $REQ["F_EMAIL"]);
alog("REQ.F_PASSWD = ". $REQ["F_PASSWD"]);

if($REQ["F_EMAIL"] == ""){JsonMsg("500","100","F_EMAIL 입력해 주세요.");}
if($REQ["F_PASSWD"] == ""){JsonMsg("500","200","F_PASSWD 입력해 주세요.");}

$REQ["F_PASSWD_HASH"] = pwd_hash($REQ["F_PASSWD"],$CFG_SEC_SALT);

alog("REQ.F_PASSWD_HASH = ". $REQ["F_PASSWD_HASH"]);

//DB연결 정보 생성
$db = db_obj_open(getDbSvrInfo("DATING"));

$coltype = "s";
$sql = "
    SELECT
        USR_SEQ, USR_ID, USR_NM, USR_PWD, PW_ERR_CNT
        , LOCK_LIMIT_DT
    FROM CMN_USR 
    WHERE USE_YN = 'Y' and USR_ID = #{F_EMAIL}
";

$stmt = makeStmt($db,$sql,$coltype,$REQ);

if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");

if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->errno . " -> " . $db->error);

$result = $stmt->get_result();

//기본정보
$REQ["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; 
$REQ["SERVER_NAME"] = $_SERVER["SERVER_NAME"]; 
$REQ["USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"]; 
$REQ["SESSION_ID"] = session_id(); 

if($row = $result->fetch_array(MYSQLI_NUM))
{

    //아직 잠겨있는 시간인지 확인
    $nowDt = date("YmdHis");
    if(strlen($row[5]) == 14 && $nowDt <  $row[5]){

        //로그정보
        $REQ["SUCCESS_YN"] = "N";
        $REQ["RESPONSE_MSG"] = "ID EXIST, ID LOCK."; 	
        $REQ["USR_SEQ"] = 0;
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        saveLoginLog($REQ);

        //객체 해제
        $stmt->close();$db->close();unset($objAuth);
        
        //RESPONSE 하기
        JsonMsg("200","220","해당 계정은 잠겨 있습니다. (" . $row[5] . " 까지)");
    }else if($row[3] == $REQ["F_PASSWD_HASH"]){
        //비밀번호가 일치 하는지 검사
        //log("0 : " . $row[0]);
        //alog("1 : " . $row[1]);
        //alog("2 : " . $row[2]);
        //echo "<br>USR_SEQ : " . $row["USR_SEQ"];

        //사용자정보 세팅
        $REQ["USR_SEQ"] = $row[0];
        $REQ["SUCCESS_YN"] = "Y";
        $REQ["RESPONSE_MSG"] = "ID EXIST, NO LOCK, PW EQUAL."; 	            
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        $REQ["USR_NM"] = $row[2];

        //비밀번호 틀린횟수가 1이상이면 비밀에 비밀번호 틀린횟수 및 잠금상태 초기화
        if($row[4] >= 1){
            //비번틀림 및 잠금정보 초기화        
            $coltype = "is";
            $sql = "
                UPDATE  CMN_USR SET 
                    PW_ERR_CNT = 0, LOCK_LIMIT_DT = null, LOCK_LAST_DT = null
                    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_ID = #{USR_SEQ}
                WHERE USR_ID = #{F_EMAIL} 
            ";
            $REQ["LOCKCD"] = "UNLOCK";

            $stmt = makeStmt($db,$sql,$coltype,$REQ);
            if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
        }

        //마지막 로그인세션 기록용(중복로그인 방지)
        $objAuth->setLastSession($REQ["USR_SEQ"],session_id());

        //권한정보 받아오기
        $arrAuth = getUserAuthArray();
        //var_dump($arrAuth);
        $objAuth->setUserAuth($arrAuth);

        //로그정보
        $REQ["AUTH_JSON"] = json_encode($arrAuth);
        $LoginSeq = saveLoginLog($REQ);

        //인트로 URL가져오기
        $introUrl = getMyGrpIntroUrl();


        //세션부여
        setUserSeq($REQ["USR_SEQ"]);
        setUserId($REQ["USR_ID"]);
        setUserNm($REQ["USR_NM"]);     
        setIntroUrl($introUrl);             
        setLoginSeq($LoginSeq);     

        //객체 해제
        $stmt->close();$db->close();unset($objAuth);

        //RESPONSE 하기
        JsonMsg("200","100","로그인에 성공했습니다.");
    }else{
        
        //비밀번호가 일치하지 않는 경우 (5번 5분, 10번 10분)
        $REQ["LOCK_LIMIT_DT"] = "";
        if($row[4]+1 == 5){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i")+5, date("s"), date("m")  , date("d"), date("Y")) );
        }else if($row[4]+1 == 10){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i")+10, date("s"), date("m")  , date("d"), date("Y")) );      
        }else if($row[4]+1 == 15){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H")+1, date("i"), date("s"), date("m")  , date("d"), date("Y")) );      
        }else if($row[4]+1 >= 20){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y")) );      
        }else{
            //처리 없음
        }


        
        $REQ["USR_SEQ"] = $row[0];
        if( $REQ["LOCK_LIMIT_DT"] != ""){
            //잠금 처리
            $coltype = "sis";
            $sql = "
                UPDATE  CMN_USR SET 
                    PW_ERR_CNT = PW_ERR_CNT + 1,  LOCK_LIMIT_DT = #{LOCK_LIMIT_DT}
                    , LOCK_LAST_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_ID = #{USR_SEQ}
                WHERE USR_ID = #{F_EMAIL} 
            ";
            $REQ["RESPONSE_MSG"] = "ID EXIST, NO LOCK, GO LOCK, PW NOT EQUAL."; 	
            $REQ["LOCKCD"] = "GOLOCK";
            $REQ["PW_ERR_CNT"] = $row[4] + 1;      
        }else{
            //PW 오류 카운트 증가        
            $coltype = "is";
            $sql = "
                UPDATE  CMN_USR SET 
                    PW_ERR_CNT = PW_ERR_CNT + 1
                    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_ID = #{USR_SEQ}
                WHERE USR_ID = #{F_EMAIL} 
            ";
            $REQ["PW_ERR_CNT"] = $row[4] + 1;
            $REQ["RESPONSE_MSG"] = "ID EXIST, NO LOCK, GO PW_ERR_CNT, PW NOT EQUAL."; 	
        }
        $stmt = makeStmt($db,$sql,$coltype,$REQ);
            
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);

        //로그정보
        $REQ["SUCCESS_YN"] = "N";

        $REQ["USR_SEQ"] = 0;
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        saveLoginLog($REQ);


        //객체 해제
        $stmt->close();$db->close();unset($objAuth);
        
        JsonMsg("200","210","이메일(ID) 혹은 비밀번호가 일치하지 않습니다.");
    }
    

}else{

    //로그정보
    $REQ["SUCCESS_YN"] = "N";
    $REQ["RESPONSE_MSG"] = "ID NOT EXIST."; 	    
    $REQ["USR_SEQ"] = 0;
    $REQ["USR_ID"] = $REQ["F_EMAIL"];
    saveLoginLog($REQ);



    //객체 해제
    $stmt->close();$db->close();unset($objAuth);

    JsonMsg("200","210","이메일(ID) 혹은 비밀번호가 일치하지 않습니다.");    
}

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
    
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->errno . " -> " . $db->error);
    

    $tArr =  getStmtArray($stmt);
    $stmt->close();
    return $tArr;
}

function getUserAuthArray(){
    global $db,$REQ;

    $coltype = "is";
    $sql = "
        select b.PGMID, b.AUTH_ID
        from CMN_GRP_USR a
            join CMN_GRP_AUTH b on a.GRP_SEQ = b.GRP_SEQ
            join CMN_MNU c on b.PGMID = c.PGMID
        where a.USR_SEQ = #{USR_SEQ}
        and c.PGMTYPE IN (
                select PGMTYPE from CMN_IP where IP = #{REMOTE_ADDR}
            )
        order by b.PGMID, b.AUTH_ID
    ";
    
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $db->errno . " -> " . $db->error);
    

    $tArr =  getStmtArray($stmt);
    $stmt->close();

    $lastPgmid = "";
    $rtnVal = null;
    for($i=0;$i<count($tArr);$i++){
        $tMap = $tArr[$i];
        if($lastPgmid != $tMap["PGMID"]){
            $rtnVal[$tMap["PGMID"]] = array();
            $j=0;          
        }else{
            $j++;        
        }
        $rtnVal[$tMap["PGMID"]][$j] = $tMap["AUTH_ID"];
        $lastPgmid = $tMap["PGMID"];
    }
    
    return $rtnVal;
}

function saveLoginLog($REQ){
    global $db, $_SERVER;


    $coltype = "sssss isiss ss";
    $sql = "
        insert into CMN_LOG_LOGIN ( 
            USR_ID, SESSION_ID, SUCCESS_YN, RESPONSE_MSG, LOCKCD
            , PW_ERR_CNT, LOCK_LIMIT_DT, USR_SEQ, SERVER_NAME, REMOTE_ADDR
            , USER_AGENT, AUTH_JSON
            , ADD_DT
        ) values (
            #{USR_ID}, #{SESSION_ID}, #{SUCCESS_YN}, #{RESPONSE_MSG}, #{LOCKCD}
            , #{PW_ERR_CNT}, #{LOCK_LIMIT_DT},#{USR_SEQ}, #{SERVER_NAME}, #{REMOTE_ADDR}
            , #{USER_AGENT}, #{AUTH_JSON}
            , date_format(sysdate(),'%Y%m%d%H%i%s')
        ) 
    ";
    
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 생성 실패 했습니다.");
    
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패 " .  $stmt->error);
    
    return  $db->insert_id;
}
?>