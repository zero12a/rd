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

if($ctl == "STEP2_END"){
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


    // Valid file extensions
    $valid_extensions = array("sql","txt");



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


}

//최초 config_init 호출시 사용
function getFirstConfigData(){

}

?>