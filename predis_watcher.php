<?php
$CFG = include_once("../c.g/incConfig.php");

if(!include_once "../c.g/include/incUtil.php")die("(die) incUtil not include");

//search nm, execute sh
$watcherTarget = array(
	array(
			"SEARCH_NM"=>"predis_logger2.php"
			,"EXECUTE_SH"=> $CFG["CFG_DEPLOY_DIR"] . "predis_logger2.sh"
		)
	,array(
			"SEARCH_NM"=>"predis_loggerCG.php"
			,"EXECUTE_SH"=> $CFG["CFG_DEPLOY_DIR"] . "predis_loggerCG.sh"
	)		
);

for($i=0;$i<sizeof($watcherTarget);$i++){
	$tmp = $watcherTarget[$i];

	$output = shell_exec("ps -ef|grep " . $tmp["SEARCH_NM"]. "|grep -v grep");
	//alog("\n" . $output;
	if(strpos($output, $tmp["SEARCH_NM"]) > 0){
		alog($tmp["SEARCH_NM"] . " process live.");
	}else{
		alog($tmp["SEARCH_NM"] . " process not live.");
		alog(" exec = " . $tmp["EXECUTE_SH"]);
		shell_exec( $tmp["EXECUTE_SH"] . " > /dev/null 2>&1 &");
	}
}
?>
