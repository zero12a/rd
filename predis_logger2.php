<?php
  
//ini_set('default_socket_timeout', 0);
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

$CFG = include_once(__DIR__ . "/../c.g/incConfig.php");

require_once(__DIR__ . "/../common/include/incUtil.php");
require_once(__DIR__ . "/../common/include/incSec.php");
require_once(__DIR__ . "/../common/include/incDB.php");


require_once($CFG["CFG_LIBS_PATH_REDIS"]);


Predis\Autoloader::register();

echo "redis go<hr>";

$redisSvr = $CFG["CFG_AUTH_REDIS"] . "?read_write_timeout=0";
echo $redisSvr;
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

while (1==1) {
	echo "\t(loggerAUTH) LIST(log_auth).length = " . $clientAuthQ->llen( 'log_auth' ) . "\n";

	//수시 큐의 로그를 DB에 저장
	while($value = $clientAuthQ->lpop( 'log_auth' )){
		
		echo "\t" . $value . "\n";
		logUsrAuth($value);
	}
	
	echo "\t(loggerAUTH) LIST(log_authd).length = " . $clientAuthQ->llen( 'log_authd' ) . "\n";

	//수시 큐의 로그를 DB에 저장
	while($value = $clientAuthQ->lpop( 'log_authd' )){
		
		echo "\t" . $value . "\n";
		logUsrAuthD($value);
	}

	//잠시 쉬었다.
	alog("(loggerAUTH) sleep 1 second."); 
	sleep(1);
} 



$db->close();

if($db)unset($db);



function logUsrAuth($jsonStr){
    
    $db = db_obj_open(getDbSvrInfo("SC"));

    $tMap = json_decode($jsonStr,true);
    $tMap = $tMap["MAP"];

	if(!is_numeric($tMap["USR_SEQ"])){
		$tMap["USR_SEQ"] = 0;
	}

    $coltype = "ssiss ss";
    
    $sql = "
        insert into CMN_LOG_AUTH (
            REQ_TOKEN, RES_TOKEN, USR_SEQ, USR_ID, PGMID, AUTH_ID
            , SUCCESS_YN
            ,ADD_DT
            ) values (
            #{REQ_TOKEN}, #{RES_TOKEN}, #{USR_SEQ}, ifnull(#{USR_ID},0), #{PGMID}
            , #{AUTH_ID}, #{SUCCESS_YN}
            ,date_format(sysdate(),'%Y%m%d%H%i%s')
            )
    ";

    $stmt = makeStmt($db,$sql,$coltype,$tMap);

    if(!$stmt)JsonMsg("500","140","[logUsrAuth] SQL makeStmt 생성 실패 했습니다.");

    if(!$stmt->execute())JsonMsg("500","150","[logUsrAuth] stmt 실행 실패" . $stmt->error);
            
    $RtnVal = $db->insert_id;
    $stmt->close();    
}




function logUsrAuthD($jsonStr){
    
    $db = db_obj_open(getDbSvrInfo("DATING"));

    $tMap = json_decode($jsonStr,true);
    $tMap = $tMap["MAP"];

    $tMap["DD_COLIDS"] = array2ddstr($tMap["COLIDS"],", "); //중복허용
    $tMap["PI_IN_COLIDS"] = array2pistr($tMap["COLIDS"],", "); //중복제거
    $tMap["PI_OUT_COLIDS"] = array2pistr(getSqlSelect2Array($tMap["PREPARE_SQL"]),", "); //SQL에서 SELECT 컬럼 추출하기

    $coltype = "ssiss ssssi";
    $sql = "
        insert into CMN_LOG_AUTHD (
            REQ_TOKEN, RES_TOKEN, LAUTH_SEQ, PREPARE_SQL, FULL_SQL
            , PARAM_COLIDS, DD_COLIDS, PI_IN_COLIDS, PI_OUT_COLIDS, ROW_CNT
            ,ADD_DT
            ) values (
            #{REQ_TOKEN}, #{RES_TOKEN}, #{LAUTH_SEQ}, #{PREPARE_SQL}, #{FULL_SQL}
            , #{PARAM_COLIDS}, #{DD_COLIDS}, #{PI_IN_COLIDS}, #{PI_OUT_COLIDS}, #{ROW_CNT}
            , date_format(sysdate(),'%Y%m%d%H%i%s')
            )
    ";                

    $stmt = makeStmt($db,$sql,$coltype,$tMap);

    if(!$stmt)JsonMsg("500","160","[logUsrAuthD] SQL makeStmt 생성 실패 했습니다.");

    if(!$stmt->execute())JsonMsg("500","170","[logUsrAuthD] stmt 실행 실패 " . $stmt->error);
            
    $RtnVal = $db->insert_id;
    $stmt->close();
}


/*
$client->pubSubLoop(['subscribe' => 'PUBSUB_AUTH_LOG'], function ($l, $msg) {
    if ($msg->payload === 'Quit') {
      return false;
    } else {
        //메시지 수신
        echo "<hr>" . date('h:i:s ') . "$msg->payload on $msg->channel", PHP_EOL;

        //수시 큐의 로그를 DB에 저장
        while($value = $l->lpop( 'auth_log' )){
            echo "\t" . $value . "\n";
        }

    }
  });
  
*/
?>