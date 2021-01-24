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

//var_dump($_FILES);
$ctl = $_GET["CTL"];

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

    if(strlen($jsonString) > 0){
        JsonMsg("500","100","이미 CONFIG 설정이 완료되었습니다. Config length is " . strlen($jsonString));
    }else{
        JsonMsg("200","100",getFirstConfigData());
    }
    echo 44444;

}else if($ctl == "STEP2_END"){
    $REQ["DBMS_DATA"] = json_decode($_POST["DBMS_DATA"],true);

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
    }else{
        JsonMsg("200","100","db연결 테스트 성공했습니다.");
    }

}else{
    //최종 단계
    //10 DB초기화 등록
    //20 초기파라미터 정보 불러오기
    //30 저장할 파라미터 정보 생성
    //40 redis서버에 반영
    //50 redis변경 알람(타 컨테이너에도 반영되게) 
    //60 admin사용자를 최고관리자 그룹에 넣기


    // Valid file extensions
    $valid_extensions = array("sql","txt");


    //10 DB초기화 등록
    if (isset($_FILES)) {
        echo "<br>is set ok";
        $file = $_FILES["SQL_FILES"];
        //var_dump($file);
        //exit;

        $REQ["DBMS_DATA"] = json_decode($_POST["DBMS_DATA"],true);
        //var_dump($REQ);

        for($t=0;$t<count($REQ["DBMS_DATA"]);$t++){
            $tDbId = $REQ["DBMS_DATA"][$t]["DBID"];
            echo "<BR> $t DBID : " . $tDbId;

            // File extension
            $name = $file["name"][$tDbId];
            $extension = pathinfo($name, PATHINFO_EXTENSION);

            echo "<BR> 파일이름 : " . $name;
            echo "<BR> 확장자 : " . strtolower($extension);
            // Check extension
            if(!in_array(strtolower($extension),$valid_extensions) ) {
                echo $extension . "는 업로드 허용된 확장자가 아닙니다.";
                exit;
            }


            $error = $file["error"][$tDbId];

            $type = $file["type"][$tDbId];
            $size = $file["size"][$tDbId];
            $tmp_name = $file["tmp_name"][$tDbId];
            
            if ( $error > 0 ) {
                echo "<br>Error: " . $error . "<br>";
            } 

            //파일 열어서 변수에 담기
            $myfile = fopen($tmp_name, "r") or die("Unable to open file!");
            $sqlQuery = fread($myfile,filesize($tmp_name));
            fclose($myfile);


            //DB연결 정보 생성
            $tDbmsObj = $REQ["DBMS_DATA"][$t];
            $tDbmsObj["ID"] = $tDbmsObj["UID"];
            try{
                $db = getDbConnPlain($tDbmsObj);
            } catch(Exception $e) {
                echo "<br>db 연결시 오류가 발생했습니다." . $e->getMessage();
                closeDb($db);
                exit;
            }

            if ($db->multi_query($sqlQuery)) {
                echo "<br>성공했습니다.";
            }else{
                echo "<br>실패했습니다.";
            }
            closeDb($db);

        }



        echo "<br>tmp_name = " .  $tmp_name;
    }else{
        echo "<br>not file";
    }
    echo "<br>test1 = " . $_POST["test1"];


    //20 초기파라미터 정보 불러오기
    $firstCfgArray = json_decode(getFirstConfigData(),true);

    //30 저장할 파라미터 정보 생성
    $saveCfgArray = array();
    $saveCfgArray["CFG_PROJECT_NAME"] = $REQ["CFG_PROJECT_NAME"];
    $saveCfgArray["CFG_SEC_KEY"] = $REQ["CFG_SEC_KEY"];
    $saveCfgArray["CFG_SEC_IV"] = $REQ["CFG_SEC_IV"];
    $saveCfgArray["CFG_SEC_SALT"] = $REQ["CFG_SEC_SALT"];
    $saveCfgArray["CFG_URL_LIBS_ROOT"] = $REQ["CFG_URL_LIBS_ROOT"];
    $saveCfgArray["ADMIN_PWD"] = $REQ["ADMIN_PWD"];
    $saveCfgArray["ADMIN_ID"] = $REQ["ADMIN_ID"];
    $saveCfgArray["CFG_LDAP_HOST"] = $REQ["CFG_LDAP_HOST"];
    $saveCfgArray["CFG_DAP_PORT"] = $REQ["CFG_DAP_PORT"];
    $saveCfgArray["CFG_DB"] = json_decode($REQ["CFG_DB"],true);
    $saveCfgArray["CFG_FILESTORE"] = json_decode($REQ["CFG_FILESTORE"],true);
    
    //40 redis서버에 반영
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
	$redisClient->set($CFG["CONFIG_NM"],json_encode($saveCfgArray));


    //50 redis변경 알람(타 컨테이너에도 반영되게) 
    $redisClient->publish("config." . $CFG["CONFIG_NM"],$CFG["CONFIG_NM"] . " change redis config data.");
	$redisClient->quit();

    //60 admin사용자를 최고관리자 그룹에 넣기(공통DB)
    $db = getDbConn($saveCfgArray["CFG_DB"]["CMN"]);

    //61사용자에 넣기]
    $REQ["USR_ID"] = $REQ["ADMIN_ID"];
    $REQ["USR_PWD"] = pwd_hash($REQ["ADMIN_PWD"],$saveCfgArray["CFG_SEC_SALT"] );
    $sql = "insert into CMN_USR (USR_ID, USR_NM, USE_YN, USR_PWD, ADD_DT, ADD_ID) values (
        #{USR_ID}, '관리자', 'Y', #{USR_PWD}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
    )";
    $sqlMap = getSqlParam($sql,$coltype="",$REQ);
    $stmt = getStmt($db,$sqlMap);
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
    if($stmt instanceof PDOStatement){
        $REQ["USR_SEQ"] = $db->lastInsertId(); //insert문인 경우 insert id받기                            
    }else{
        $REQ["USR_SEQ"] = $db->insert_id; //insert문인 경우 insert id받기
    }

    //62그룹사용자에 넣기
    //GRP_SEQ이 1이면 관리자그룹
    $sql = "insert into CMN_GRP_USR (GRP_SEQ, USR_SEQ, ADD_DT, ADD_ID) values (
        1, #{USR_SEQ}, date_format(sysdate(),'%Y%m%d%H%i%s') , 0
    )
    ";
    $sqlMap = getSqlParam($sql,$coltype="",$REQ);
    $stmt = getStmt($db,$sqlMap);
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);

    closeStmt($stmt);


}

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
                "DBID": "CG",
                "DRIVER": "",
                "HOST": "172.17.0.1",
                "PORT": "3306",
                "DBNM": "CG",
                "UID": "",
                "PW": ""
            },
            {
                "DBID": "DATING",
                "DRIVER": "",
                "HOST": "172.17.0.1",
                "PORT": "3306",
                "DBNM": "DATING",
                "UID": "",
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