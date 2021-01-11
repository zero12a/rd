<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


var_dump($_FILES);

if (isset($_FILES)) {
    echo "is set ok";
    $file = $_FILES["SQL_FILES"];

    $error = $file["error"];

    $name = $file["name"];
    $type = $file["type"];
    $size = $file["size"];
    $tmp_name = $file["tmp_name"];
   
    if ( $error > 0 ) {
        echo "Error: " . $error . "<br>";
    } 


    echo $tmp_name;
}else{
    echo "not file";
}
?>