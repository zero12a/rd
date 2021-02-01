<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

$CFG = require_once("../common/include/incConfig.php");

require_once($CFG["CFG_LIBS_VENDOR"]);
//var_dump($CFG);

require_once("../common/include/incDB.php");
require_once("../common/include/incSec.php");
require_once("../common/include/incUtil.php");
require_once("../common/include/incUser.php");
require_once("../common/include/incAuth.php");
require_once("../common/include/incRequest.php");


$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$pgmId = "CONFIG_MOD";

$log = getLogger(
	array(
	"LIST_NM" => "log_CG"
	, "PGM_ID" => $pgmId 
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("Config_mod_api___________________________start");
$objAuth = new authObject();

//var_dump($_FILES);
$ctl = $_GET["CTL"];

//로그인 : 권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth($pgmId,$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,$pgmId,$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,$pgmId,$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}


if($ctl == "STEP1_START"){
    //redis 서버 config가 이미 등록되어 있는지 정보 가져오기
    
	//세션 사용
	if($CFG["REDIS_PASSWD"] != ""){
		$redisClient = new Predis\Client(
			array(
				'scheme' => 'tcp',
				'host'   => $CFG["REDIS_HOST"],
				'port'   => $CFG["REDIS_PORT"],
				'password'   => $CFG["REDIS_PASSWD"],
				'timeout' => 1
			));
	}else{
		$redisClient = new Predis\Client(
			array(
				'scheme' => 'tcp',
				'host'   => $CFG["REDIS_HOST"],
				'port'   => $CFG["REDIS_PORT"],
				'timeout' => 1
			));
    }
    
	$jsonString = $redisClient->get($CFG["CONFIG_NM"]);
    $redisClient->quit();
    
    //암호화 되어 있는 컬럼 정보 풀어서 리턴하기
    $plainJsonArray = json_decode($jsonString,true);
    $i = 0;
    //echo "CFG_SEC_KEY = " . $CFG["CFG_SEC_KEY"] . PHP_EOL;
    //echo "CFG_SEC_IV = " . $CFG["CFG_SEC_IV"]. PHP_EOL;

    foreach($plainJsonArray["CFG_DB"] as $key => $value){
        //echo $key . " PW = " . $plainJsonArray["CFG_DB"][$key]["PW"];
        //$plainPw = aesDecrypt($plainJsonArray["CFG_DB"][$key]["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);
        //echo $key . " = " . $plainPw . PHP_EOL;
        $plainJsonArray["CFG_DB"][$key]["PW"] = aesDecrypt($plainJsonArray["CFG_DB"][$key]["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);
    }
    foreach($plainJsonArray["CFG_FILESTORE"] as $key => $value){
        //echo $key . " PW = " . $plainJsonArray["CFG_DB"][$key]["PW"];
        //$plainPw = aesDecrypt($plainJsonArray["CFG_FILESTORE"][$key]["PW"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);
        //echo $key . " = " . $plainPw . PHP_EOL;
        $plainJsonArray["CFG_FILESTORE"][$key]["CREKEY"] = aesDecrypt($plainJsonArray["CFG_FILESTORE"][$key]["CREKEY"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);
        $plainJsonArray["CFG_FILESTORE"][$key]["CRESECRET"] = aesDecrypt($plainJsonArray["CFG_FILESTORE"][$key]["CRESECRET"],$CFG["CFG_SEC_KEY"],$CFG["CFG_SEC_IV"]);

    }

    //var_dump($plainJsonArray);
    $plainJsonSring = json_encode($plainJsonArray,JSON_UNESCAPED_UNICODE|JSON_INVALID_UTF8_IGNORE);
    //echo 'Last error = ' . json_last_error_msg() . PHP_EOL;
    //echo "plainJsonSring = " . $plainJsonSring . PHP_EOL;

    if(strlen($jsonString) > 0 ){
        JsonMsg("200","100",$plainJsonSring);
    }else{
        JsonMsg("500","100","CONFIG가 설정되어 있지 않습니다.. Config length is " . strlen($jsonString));        
    }
    //echo 44444;

}else if($ctl == "STEP1_END"){
    //최종 단계
    //10 DB변경 정보로 연결 테스트
    //20 CFG 현재redis파라미터 정보 불러오기
    //30 저장할 파라미터 정보 생성
    //35 redist서버에서 기존 config 백업
    //40 redis서버에 신규 config 반영
    //50 redis변경 알람(타 컨테이너에도 반영되게) 

    //00 외부입력 파라미터 받아오기
    $REQ["PROPERTY"] = json_decode($_POST["PROPERTY"],true);
    $REQ["DBMS_DATA"] = json_decode($_POST["DBMS_DATA"],true);
    $REQ["FILESTORE_DATA"] = json_decode($_POST["FILESTORE_DATA"],true);

    //10 DB변경 정보로 연결 테스트
    $errMsg = "";
    for($t=0;$t<count($REQ["DBMS_DATA"]);$t++){
        //DB연결 정보 생성
        $tDbmsObj = $REQ["DBMS_DATA"][$t];
        $tDbmsObj["ID"] = $tDbmsObj["UID"];
        try{
            $db = getDbConnPlain($tDbmsObj);
        } catch(Exception $e) {
            $errMsg .= $tDbmsObj["DBID"] . "가 DB연결 테스트 실패했습니다.(db connect fail.)";
            alog("db 연결시 오류가 발생했습니다." . $e->getMessage());
        }
        closeDb($db);
    }

    if($errMsg != ""){
        JsonMsg("500","100",$errMsg);
    }

    //20 CFG 현재redis파라미터 정보 불러오기
	if($CFG["REDIS_PASSWD"] != ""){
		$redisClient = new Predis\Client(
			array(
				'scheme' => 'tcp',
				'host'   => $CFG["REDIS_HOST"],
				'port'   => $CFG["REDIS_PORT"],
				'password'   => $CFG["REDIS_PASSWD"],
				'timeout' => 1
			));
	}else{
		$redisClient = new Predis\Client(
			array(
				'scheme' => 'tcp',
				'host'   => $CFG["REDIS_HOST"],
				'port'   => $CFG["REDIS_PORT"],
				'timeout' => 1
			));
    }    
    $oldCfgJsonStr = $redisClient->get($CFG["CONFIG_NM"]);
    $oldCfgArray = json_decode($oldCfgArray,true);

    //30 저장할 파라미터 정보 생성
    $saveCfgArray = $oldCfgArray;
    $saveCfgArray["CFG_PROJECT_NAME"]   = $REQ["PROPERTY"]["CFG_PROJECT_NAME"];
    $saveCfgArray["CFG_SEC_KEY"]        = $REQ["PROPERTY"]["CFG_SEC_KEY"];
    $saveCfgArray["CFG_SEC_IV"]         = $REQ["PROPERTY"]["CFG_SEC_IV"];
    $saveCfgArray["CFG_SEC_SALT"]       = $REQ["PROPERTY"]["CFG_SEC_SALT"];
    $saveCfgArray["CFG_URL_LIBS_ROOT"]  = $REQ["PROPERTY"]["CFG_URL_LIBS_ROOT"];
    $saveCfgArray["CFG_LDAP_HOST"]      = $REQ["PROPERTY"]["CFG_LDAP_HOST"];
    $saveCfgArray["CFG_LDAP_PORT"]      = $REQ["PROPERTY"]["CFG_LDAP_PORT"];

    $tDbmsData = array();
    for($i=0;$i<count($REQ["DBMS_DATA"]);$i++){
        $tDbmsData[$REQ["DBMS_DATA"][$i]["DBID"]] = array(
            "DRIVER" => $REQ["DBMS_DATA"][$i]["DRIVER"],
            "HOST" => $REQ["DBMS_DATA"][$i]["HOST"],
            "PORT" => $REQ["DBMS_DATA"][$i]["PORT"],
            "DBNM" => $REQ["DBMS_DATA"][$i]["DBNM"],
            "ID" => $REQ["DBMS_DATA"][$i]["UID"],
            "PW" => aesEncrypt($REQ["DBMS_DATA"][$i]["PW"],$REQ["PROPERTY"]["CFG_SEC_KEY"],$REQ["PROPERTY"]["CFG_SEC_IV"])
        );
    }
    $saveCfgArray["CFG_DB"] = $tDbmsData;

    $tFilestoreData = array();
    for($i=0;$i<count($REQ["FILESTORE_DATA"]);$i++){
        $tFilestoreData[$REQ["FILESTORE_DATA"][$i]["STOREID"]] = array(
            "STORETYPE" => $REQ["FILESTORE_DATA"][$i]["STORETYPE"],
            "UPLOADDIR" => $REQ["FILESTORE_DATA"][$i]["UPLOADDIR"],
            "READURL" => $REQ["FILESTORE_DATA"][$i]["READURL"],
            "CREKEY" => aesEncrypt($REQ["FILESTORE_DATA"][$i]["CREKEY"],$REQ["PROPERTY"]["CFG_SEC_KEY"],$REQ["PROPERTY"]["CFG_SEC_IV"]),
            "CRESECRET" => aesEncrypt($REQ["FILESTORE_DATA"][$i]["CRESECRET"],$REQ["PROPERTY"]["CFG_SEC_KEY"],$REQ["PROPERTY"]["CFG_SEC_IV"]),
            "REGION" => $REQ["FILESTORE_DATA"][$i]["REGION"],
            "BUCKET" => $REQ["FILESTORE_DATA"][$i]["BUCKET"],
            "ACL" => $REQ["FILESTORE_DATA"][$i]["ACL"]
        );
    }        
    $saveCfgArray["CFG_FILESTORE"] = $tFilestoreData;

    //echo PHP_EOL . "333";

    //35 redist서버에서 기존 config 백업


	$redisClient->set($CFG["CONFIG_NM"] . "." . date("Ymd"), $oldCfgJsonStr );

    //40 redis서버에 신규 config 반영
	$redisClient->set($CFG["CONFIG_NM"],json_encode($saveCfgArray));


    //50 redis변경 알람(타 컨테이너에도 반영되게) 
    $redisClient->publish("config." . $CFG["CONFIG_NM"],$CFG["CONFIG_NM"] . " change redis config data.");
	$redisClient->quit();

    
    closeStmt($stmt);
    closeDb($db);

    //최종 성공 리턴
    JsonMsg("200","100","Success mod save.");
}

//서비스 클래스 비우기
unset($objAuth);

$log->info("Config_mod_api___________________________end");
$log->close(); unset($log);

//최초 config_init 호출시 사용
function getFirstConfigData(){

    //CFG_DB는 3가지 종류가 필요
    //1. 서비스DB
    //2. 공통DB(권한, 사용자, 코드관리)
    //3. 로그DB

    //FILESTORE_DB는 2가지 종류가 필요
    //1. 서비스FS
    //2. 공통FS(웹에디터)

    $firstConfig = <<<EOT
    {
        "CFG_LIBS_VENDOR": "/data/www/lib/php/vendor/autoload.php",
        "CFG_LIBS_PATH_REDIS": "/data/www/lib/php/vendor/predis/predis/autoload.php",
        "CFG_LIBS_PATH_AWS": "/data/www/lib/php/vendor/autoload.php",
        "CFG_LIBS_SQL_PARSER": "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php",
        "CFG_LIBS_HTML_PURIFIER": "/data/www/lib/php/HTMLPurifier-4.12.0/library/HTMLPurifier.auto.php",
        "CFG_LIBS_MONO_LOG": "/data/www/lib/php/vendor/autoload.php",
        "CFG_LIBS_EXCEL": "/data/www/lib/php/vendor/autoload.php",
        "CFG_SID_PREFIX": "CG",
        "CFG_PROJECT_NAME": "리얼 만남svr",
        "CFG_OAUTH_HOST": "172.17.0.1",
        "CFG_OAUTH_PORT": "18052",
        "CFG_LDAP_HOST": "172.17.0.1",
        "CFG_LDAP_PORT": "389",
        "CFG_SEC_KEY": "8F12A9C3BCAFD81D520F7B61140F454842BEEA94A29A01F8",
        "CFG_SEC_IV": "4LUoikddG3mPQsV/ELjRCQ==",        
        "CFG_SEC_SALT": "codegen",
        "CFG_FILESTORE": [     
            {
                "STOREID": "LOCAL_1",
                "STORETYPE": "LOCAL",
                "UPLOADDIR": "/data/www/up/",
                "READURL": "/up/",
                "CREKEY": "",
                "CRESECRET": "",
                "REGION": "",
                "BUCKET": "",
                "ACL": "public-read"
            },
            {
                "STOREID": "S3_1",
                "STORETYPE": "S3",
                "UPLOADDIR": "",
                "READURL": "",
                "CREKEY": "",
                "CRESECRET": "",
                "REGION": "ap-northeast-2",
                "BUCKET": "codegen-test-bucket",
                "ACL": "private"
            }
        ],
        "CFG_DB": [ 
            {
                "DBID": "COMMON",
                "DRIVER": "MYSQLI",
                "HOST": "172.17.0.1",
                "PORT": "3306",
                "DBNM": "RD_COMMON",
                "UID": "cg",
                "PW": ""
            },
            {
                "DBID": "SERVICE",
                "DRIVER": "MYSQLI",
                "HOST": "172.17.0.1",
                "PORT": "3306",
                "DBNM": "RD_SERVICE",
                "UID": "cg",
                "PW": ""
            }
        ],
        "CFG_ROOT_DIR": "/data/www/c.g/",
        "CFG_COMMON_DIR": "/data/www/common/",
        "CFG_LOG_PATH": "/data/www/log/",
        "CFG_LOG_PATH2": "/data/www/log/",
        "CFG_UPLOAD_ALLOW_EXT": [
            "jpg",
            "gif",
            "png",
            "peng",
            "bmp",
            "svg",
            "xls",
            "xlsx",
            "doc",
            "docx",
            "ppt",
            "pptx",
            "pdf",
            "hwp",
            "txt"
        ],
        "CFG_URL_LIBS_ROOT": "http://localhost:8070/",
        "CFG_URL_CODE_API": "/d.s/CG/codeapiController.php"
    }    
    EOT;


    return $firstConfig;
}

?>