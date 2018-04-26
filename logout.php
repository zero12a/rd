<?

header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

session_start();

require_once("../c.g/include/incUser.php");


logOut();

header('Location: login.php?from=logout');

?>