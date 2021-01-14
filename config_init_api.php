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


// Valid file extensions
$valid_extensions = array("sql","txt");



if (isset($_FILES)) {
    echo "<br>is set ok";
    $file = $_FILES["SQL_FILES"];


    // File extension
    $extension = pathinfo($file["name"], PATHINFO_EXTENSION);

    echo "<BR> 파일이름 : " . $file["name"];
    echo "<BR> 확장자 : " . strtolower($extension);
    // Check extension
    if(!in_array(strtolower($extension),$valid_extensions) ) {
        echo $extension . "는 업로드 허용된 확장자가 아닙니다.";
        exit;
    }



    $error = $file["error"];

    $name = $file["name"];
    $type = $file["type"];
    $size = $file["size"];
    $tmp_name = $file["tmp_name"];
   
    
    if ( $error > 0 ) {
        echo "<br>Error: " . $error . "<br>";
    } 

    $myfile = fopen($tmp_name, "r") or die("Unable to open file!");
    $sqlQuery = fread($myfile,filesize($tmp_name));
    fclose($myfile);


    //DB연결 정보 생성
    $db = getDbConn($CFG["CFG_DB"]["CGPJT2"]);

    if ($db->multi_query($sqlQuery)) {
        echo "<br>성공했습니다.";
    }else{
        echo "<br>실패했습니다.";
    }
    closeDb($db);

    echo "<br>tmp_name = " .  $tmp_name;
}else{
    echo "<br>not file";
}
echo "<br>test1 = " . $_POST["test1"];
?>