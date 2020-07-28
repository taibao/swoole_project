<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 14:50
 */

//同步阻塞
$client = new Swoole\Client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);

//连接事件回调
$client->on("connect",function(swoole_client $cli){
    $cli->send("GET / HTTP/1.1 \r\n\r\n");
});


$client->on("receive",function(swoole_client $cli,$data){
    echo "Receive:$data";
});

$client->on("error",function(swoole_client $cli){
   echo "error\n";
});

$client->on("close",function(swoole_client $cli){
   echo "Connection close\n";
});

$client->connect("192.168.59.132",9800) || exit("");

//定时器
swoole_timer_tick(9000,function() use($client){
    $client->send('1');
});

echo "写日志";

