<?
//echo "dir : " . dirname(__DIR__) . PHP_EOL;

require_once("/data/www/r.d/lib/PhpRedisClient/autoloader.php");


use RedisClient\RedisClient;
use RedisClient\Client\Version\RedisClient2x6;
use RedisClient\ClientFactory;

// Example 1. Create new Instance for Redis version 2.8.x with config via factory
$Redis = ClientFactory::create([
    'server' => '192.168.210.1:1234', // or 'unix:///tmp/redis.sock'
    'timeout' => 0
]);

echo 'RedisClient: '. $Redis->getSupportedVersion() . PHP_EOL; // RedisClient: 2.8
echo 'Redis: '. $Redis->info('Server')['redis_version'] . PHP_EOL; // Redis: 3.0.3


$Redis->subscribe('PUBSUB_AUTH_LOG', function($type, $channel, $message) {
    // This function will be called on subscribe and on message
    if ($type === 'subscribe') {
        // Note, if $type === 'subscribe'
        // then $channel = <channel-name>
        // and $message = <count of subsribers>
        echo date('h:i:s ') . ' Subscribed to channel <', $channel, '>', PHP_EOL;
    } elseif ($type === 'message') {
        echo date('h:i:s ') . ' Message <', $message, '> from channel <', $channel, '>', PHP_EOL;
        if ($message === 'quit') {
            // return <false> for unsubscribe and exit
            return false;
        }
    }
    // return <true> for to wait next message
    return true;
});


?>