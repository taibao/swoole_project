<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 14:50
 */

//同步阻塞
$client = new Swoole\Client(SWOOLE_SOCK_UDP);

//发数据
$client->sendto("127.0.0.1",9800,"我是客户端");

echo $client->recv(); //接收消息