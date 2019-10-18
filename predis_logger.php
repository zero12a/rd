<?php
  
ini_set('default_socket_timeout', 0);
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

require_once(__DIR__ . "/../c.g/include/incUtil.php");
require_once(__DIR__ . "/../c.g/include/incSec.php");
require_once(__DIR__ . "/../c.g/include/incDB.php");
require_once(__DIR__ . "/../c.g/incConfig.php");



require_once("./lib/predis-1.1/autoload.php");


Predis\Autoloader::register();

echo "redis go<hr>";

$objDbInfo = getDbSvrInfo("DATING");


$logCnt = 0;
$redisSvr = "tcp://172.17.0.1:1234?read_write_timeout=0";
$clientPubSub = new Predis\Client($redisSvr);
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
//global $db;


$pubsub = $clientPubSub->pubSubLoop();
// Subscribe to your channels
$pubsub->subscribe('PUBSUB_AUTH_LOG', 'PUBSUB_AUTH_LOG2');

foreach ($pubsub as $message) {
    switch ($message->kind) {
        case 'subscribe':
            echo "[subscribe] Subscribed to {$message->channel}" . PHP_EOL;
            break;
        case 'message':
            echo "[message] message->channel : " . $message->channel . PHP_EOL;
            echo "[message] message->payload  : " . $message->payload  . PHP_EOL ;      
            
            $db = db_obj_open($objDbInfo);

            //수시 큐의 로그를 DB에 저장
            while($value = $clientAuthQ->lpop( 'log_auth' )){
                
                echo "\t[log_auth] " . ($logCnt++) . " " . $value . "\n";
                logUsrAuth($value);
            }
            
            //수시 큐의 로그를 DB에 저장
            while($value = $clientAuthQ->lpop( 'log_authd' )){
                
                echo "\t[log_authd] " . ($logCnt++) . " "  . $value . "\n";
                logUsrAuthD($value);
            }

            $db->close();
            if($db)unset($db);

            break;
        default :
            echo "[default]" . PHP_EOL;
            break;
    }
} 








function logUsrAuth($jsonStr){
    global $db;


    $tMap = json_decode($jsonStr,true);
    $tMap = $tMap["MAP"];

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

    if(!$stmt->execute())alog("[logUsrAuth] stmt 실행 실패" . $stmt->error);
            
    $RtnVal = $db->insert_id;
    $stmt->close();    


}




function logUsrAuthD($jsonStr){
    global $db;

    //$db = db_obj_open($objDbInfo);

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

    if(!$stmt->execute())alog("[logUsrAuthD] stmt 실행 실패 " . $stmt->error);
            
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