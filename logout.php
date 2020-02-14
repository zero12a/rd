<?php

header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

session_start();

require_once("../common/include/incUser.php");


logOut();

header('Location: login_oauth.php?from=logout');

?>