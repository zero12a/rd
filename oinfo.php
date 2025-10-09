<?php
echo "<pre>";

$t = array();
$t = opcache_get_status();
$c = opcache_get_configuration();

//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

//echo json_encode($arr);

//var_dump($c);

//var_dump($t);

echo json_encode(json_decode(json_encode($t)), JSON_PRETTY_PRINT);

echo "</pre>";
//phpinfo();
?>