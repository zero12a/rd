<?php
  
ini_set('default_socket_timeout', 0);
 
set_time_limit(0);

//subscribe.php
//require 'Predis/Autoloader.php';

require_once("./lib/predis-1.1/autoload.php");

Predis\Autoloader::register();

echo "redis go<hr>";

$client = new Predis\Client("tcp://192.168.1.100:1234?read_write_timeout=0");

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
/*
$pubsub = $client->pubSubLoop();
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
            break;
        default :
            echo "[default]" . PHP_EOL;
            break;
    }
} 
*/

$client->pubSubLoop(['subscribe' => 'PUBSUB_AUTH_LOG'], function ($l, $msg) {
    if ($msg->payload === 'Quit') {
      return false;
    } else {
      echo "<hr>" . date('h:i:s ') . "$msg->payload on $msg->channel", PHP_EOL;
    }
  });
  
?>