<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

$CFG = require_once("../common/include/incConfig.php");

require_once("../common/include/incDB.php");
require_once("../common/include/incSec.php");
require_once("../common/include/incUtil.php");
require_once("../common/include/incUser.php");
require_once("../common/include/incAuth.php");
require_once("../common/include/incRequest.php");
require_once('../common/include/incLdap.php');//CG LDAP


require_once('./login_class.php');//CG LDAP

//마지막 로그인 세션id기록용
$objAuth = new authObject();	
$objLogin = new loginObject();	

//외부 파라미터 받기
$REQ["F_EMAIL"] = reqPostString("F_EMAIL",100);
$REQ["F_PASSWD"] = reqPostString("F_PASSWD",30);


alog("REQ.F_EMAIL = ". $REQ["F_EMAIL"]);
alog("REQ.F_PASSWD = ". $REQ["F_PASSWD"]);

if($REQ["F_EMAIL"] == ""){JsonMsg("500","100","F_EMAIL 입력해 주세요.");}
if($REQ["F_PASSWD"] == ""){JsonMsg("500","200","F_PASSWD 입력해 주세요.");}

$REQ["F_PASSWD_HASH"] = pwd_hash($REQ["F_PASSWD"],$CFG["CFG_SEC_SALT"]);

alog("REQ.F_PASSWD_HASH = ". $REQ["F_PASSWD_HASH"]);


//기본정보
$REQ["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; 
$REQ["SERVER_NAME"] = $_SERVER["SERVER_NAME"]; 
$REQ["USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"]; 
$REQ["SESSION_ID"] = session_id(); 

$result = $objLogin->getUserInfo($REQ);

//USR_SEQ, USR_ID, USR_NM, USR_PWD, PW_ERR_CNT
//                , LOCK_LIMIT_DT, LDAP_LOGIN_YN

if($row = $result->fetch_array(MYSQLI_ASSOC))
{

    //아직 잠겨있는 시간인지 확인
    $nowDt = date("YmdHis");
    if(strlen($row["LOCK_LIMIT_DT"]) == 14 && $nowDt <  $row["LOCK_LIMIT_DT"]){

        //로그정보
        $REQ["SUCCESS_YN"] = "N";
        $REQ["RESPONSE_MSG"] = "ID EXIST, ID LOCK."; 	
        $REQ["USR_SEQ"] = $row["USR_SEQ"];
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        $objLogin->saveLoginLog($REQ);

        //객체 해제
        unset($objAuth);
        
        //RESPONSE 하기
        JsonMsg("200","220","해당 계정은 잠겨 있습니다. (" . $row["LOCK_LIMIT_DT"] . " 까지)");
    }else if($row["LDAP_LOGIN_YN"] == "Y" && strlen($CFG["CFG_LDAP_HOST"] . "") > 0){ //LDAP_LOGIN_YN
        //LDAP 로그인 검사
        $ldap = new ldapClass();
        $conObj = $ldap->connect($CFG["CFG_LDAP_HOST"]);
        //echo "<BR>ldap_error : " . ldap_error($conObj);

        if(!$conObj)JsonMsg("500","202","Ldap connect error " .  ldap_error($conObj));

        if( $ldap->login($CFG["CFG_LDAP_DOMAIN"], $REQ["F_EMAIL"],$REQ["F_PASSWD"]) ){
            //echo "<BR>로그인 성공";

            //ldap서버에서 사용자 정보 조회하기
            $userLdapMap = $ldap->getUserInfo($CFG["CFG_LDAP_HOST"]);

            //팀 정보는 신규/재로그인시 모두 반영
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $REQ["USR_NM"] = $userLdapMap["givenname"];
            $REQ["TEAMNM"] = $userLdapMap["department"];
            $REQ["TEAMCD"] = $userLdapMap["departmentnumber"];

            $objLogin->ldapLoginSuccessUserMod($REQ);

            //로그인 로그
            $REQ["SUCCESS_YN"] = "Y";
            $REQ["RESPONSE_MSG"] = "(LDAP)ID EXIST, PW EQUAL."; 	
            $REQ["USR_SEQ"] = $row["USR_SEQ"];
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $objLogin->saveLoginLog($REQ);

        }else{
            //로그인 실패
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $REQ["USR_NM"] = "";
            $REQ["TEAMNM"] = "";
            $REQ["TEAMCD"] = "";
            $REQ["PW_ERR_CNT"] = $row["PW_ERR_CNT"];

            $REQ["RESPONSE_MSG"] = $objLogin->loginFailUserMod($REQ);

            //로그인 로그
            $REQ["SUCCESS_YN"] = "N";
            $REQ["USR_SEQ"] = $row["USR_SEQ"];
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $objLogin->saveLoginLog($REQ);
        }

    }else if($row["USR_PWD"] == $REQ["F_PASSWD_HASH"]){
        //비밀번호가 일치 하는지 검사
        //log("0 : " . $row[0]);
        //alog("1 : " . $row[1]);
        //alog("2 : " . $row[2]);
        //echo "<br>USR_SEQ : " . $row["USR_SEQ"];

        //사용자정보 세팅
        $REQ["USR_SEQ"] = $row["USR_SEQ"];
        $REQ["SUCCESS_YN"] = "Y";
        $REQ["RESPONSE_MSG"] = "ID EXIST, NO LOCK, PW EQUAL."; 	            
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        $REQ["USR_NM"] = $row["USR_NM"];

        //비밀번호 틀린횟수가 1이상이면 비밀에 비밀번호 틀린횟수 및 잠금상태 초기화
        if($row["PW_ERR_CNT"] >= 1){
           $objLogin->pwClearFailCnt($REQ);
        }

        //객체 해제
        unset($objAuth);

        //RESPONSE 하기
        JsonMsg("200","100","로그인에 성공했습니다.");
    }else{
        //LDAP유저가 아닌 일반유저 pw가 틀렸을때
        $REQ["PW_ERR_CNT"] = $row["PW_ERR_CNT"];
        $objLogin->loginFailUserMod($REQ);


        //로그정보
        $REQ["SUCCESS_YN"] = "N";
        $REQ["RESPONSE_MSG"] = "ID EQUAL, PW NOT EQUAL."; 
        $REQ["USR_SEQ"] = $row["USR_SEQ"];
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        $objLogin->saveLoginLog($REQ);

        //객체 해제
        unset($objAuth);
        
        JsonMsg("200","210","이메일(ID) 혹은 비밀번호가 일치하지 않습니다.");
    }
    

}else{
    //사용자 테이블에 사용자가 없는경우
    
    if(strlen($CFG["CFG_LDAP_HOST"] . "") > 0){ //LDAP_LOGIN_YN
        //LDAP 로그인 검사
        $ldap = new ldapClass();
        $conObj = $ldap->connect($CFG["CFG_LDAP_HOST"]);
        //echo "<BR>ldap_error : " . ldap_error($conObj);

        if(!$conObj)JsonMsg("500","202","Ldap connect error " .  ldap_error($conObj));

        if( $ldap->login($CFG["CFG_LDAP_DOMAIN"], $REQ["F_EMAIL"],$REQ["F_PASSWD"]) ){
            //echo "<BR>로그인 성공";

            //ldap서버에서 사용자 정보 조회하기
            $userLdapMap = $ldap->getUserInfo($CFG["CFG_LDAP_HOST"]);

            //팀 정보는 신규/재로그인시 모두 반영
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $REQ["USR_NM"] = $userLdapMap["givenname"];
            $REQ["TEAMNM"] = $userLdapMap["department"];
            $REQ["TEAMCD"] = $userLdapMap["departmentnumber"];

            $REQ["USR_SEQ"] = $objLogin->ldapLoginSuccessUserAdd($REQ);

            //로그정보
            $REQ["SUCCESS_YN"] = "Y";
            $REQ["RESPONSE_MSG"] = "(LDAP) ID EXIST, NO LOCK, PW EQUAL."; 
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $objLogin->saveLoginLog($REQ);

            //로그인 성공
            JsonMsg("200","100","로그인에 성공했습니다.");

        }else{
            //로그인 실패
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $REQ["USR_NM"] = "";
            $REQ["TEAMNM"] = "";
            $REQ["TEAMCD"] = "";

            $REQ["USR_SEQ"] = $objLogin->loginFailUserAdd($REQ); //깡통유저 생성

            //로그정보
            $REQ["SUCCESS_YN"] = "N";
            $REQ["RESPONSE_MSG"] = "(LDAP) ID OR PW NOT EQUAL."; 
            $REQ["USR_ID"] = $REQ["F_EMAIL"];
            $objLogin->saveLoginLog($REQ);

            JsonMsg("200","210","이메일(ID) 혹은 비밀번호가 일치하지 않습니다.(LDAP)");                
        }
    
    }else{
        //LDAP사용자도 아니고 존재하지 않는 사용자 일때
        $REQ["USR_SEQ"]  = $objLogin->loginFailUserAdd($REQ);  //PW오류횟수 및 잠금 시간 처리

        //로그정보
        $REQ["SUCCESS_YN"] = "N";
        $REQ["RESPONSE_MSG"] = "ID NOT EXIST."; 	    
        $REQ["USR_ID"] = $REQ["F_EMAIL"];
        $objLogin->saveLoginLog($REQ);

        //객체 해제
        unset($objAuth);

        JsonMsg("200","220","이메일(ID) 혹은 비밀번호가 일치하지 않습니다.");    
    }

}



?>