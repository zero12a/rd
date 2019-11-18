<?php
  
ini_set('default_socket_timeout', 0);
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

require_once(__DIR__ . "/../c.g/include/incUtil.php");
require_once(__DIR__ . "/../c.g/include/incSec.php");
require_once(__DIR__ . "/../c.g/include/incDB.php");
require_once(__DIR__ . "/../c.g/incConfig.php");



require_once($CFG_LIBS_PATH_REDIS);


Predis\Autoloader::register();

echo "redis go<hr>";

$redisSvr = $CFG_AUTH_REDIS . "?read_write_timeout=0";
$clientAuthQ = new Predis\Client($redisSvr);

/*
$client = new Predis\Client(
        array(
        'scheme'   => 'tcp',
        'host'     => '192.168.210.1',
        'port'     => 1234,
        'read_write_timeout' => 0,
        'timed_out' => false
        )
    );
*/

//var_dump($client);
global $db;

$list_nm = "log_CG";
while (1==1) {
	echo "\t (loggerCG) LIST(log_cg).length = " . $clientAuthQ->llen( $list_nm ) . "\n";

	//수시 큐의 로그를 DB에 저장
	while($value = $clientAuthQ->lpop( $list_nm )){
		
		echo "\t" . $value . "\n";
		logToMonolog($value);
	}
	
	//잠시 쉬었다.
	alog("(loggerCG) sleep 1 second."); 
	sleep(1);
} 



$db->close();

if($db)unset($db);



function logToMonolog($jsonStr){
    global $list_nm;
    $db = db_obj_open(getDbSvrInfo("CG"));

    $tMap = json_decode($jsonStr,true);
    //$tMap = $tMap["MAP"];

    $tMap["LISTNM"] = $list_nm;

    //변환
    $tMap["datetime.date"] = $tMap["datetime"]["date"];
    $tMap["context.URL"]        = $tMap["context"]["URL"];
    $tMap["context.SESSIONID"]  = $tMap["context"]["SESSIONID"];
    $tMap["context.USERID"]     = $tMap["context"]["USERID"];
    $tMap["context.USERSEQ"]    = $tMap["context"]["USERSEQ"];
    $tMap["context.REQTOKEN"]    = $tMap["context"]["REQTOKEN"];
    $tMap["context.RESTOKEN"]    = $tMap["context"]["RESTOKEN"];


    $coltype = "sssis sssss s";
    
    $sql = "
        insert into CG_MONOLOG (
            URL, SESSIONID, USERID, USERSEQ, LISTNM
            , LOGLEVEL, LOGDT, LOGMSG, CHANNEL, REQTOKEN
            , RESTOKEN
            , ADDDT
        ) values (
            #{context.URL}, #{context.SESSIONID}, #{context.USERID}, #{context.USERSEQ}, #{LISTNM}
            , #{level_name}, #{datetime.date}, #{message}, #{channel}, #{context.REQTOKEN}
            , #{context.RESTOKEN}
            ,date_format(sysdate(),'%Y%m%d%H%i%s')
        )
    ";

    $stmt = makeStmt($db,$sql,$coltype,$tMap);

    if(!$stmt)ServerMsg("500","140","[logToMonolog] SQL makeStmt 생성 실패 했습니다.");

    if(!$stmt->execute())ServerMsg("500","150","[logToMonolog] stmt 실행 실패" . $stmt->error);
            
    $RtnVal = $db->insert_id;
    $stmt->close();    
}

?>