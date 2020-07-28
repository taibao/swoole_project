<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 14:50
 */

//同步阻塞
$client = new swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('192.168.59.132', 9800, -1)) {
    exit("connect failed. Error: {$client->errCode}\n");
}
$client->send("服务器你在吗，我是vitas 的mac pro");

//客户端接收服务器消息

echo "来自服务器的消息：".$client->recv(); //接收消息


echo $client->recv();
$client->close();
