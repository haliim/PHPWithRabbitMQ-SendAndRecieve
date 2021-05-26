<?php
require_once ("vendor/autoload.php");
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
$seconds = 1;
$i = 1;
$incr = 0;
while ($i <= 5) {
    sleep($seconds);
    $incr++;
    $msg = new AMQPMessage("Hello World! $incr");
    $channel->basic_publish($msg, '', 'hello');
    echo " [x] Sent $msg '\n";
  } 


  $channel->close();
  $connection->close();
