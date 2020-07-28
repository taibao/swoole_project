<?php

$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('192.168.59.1',8080, 10))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
$client->send("hello world\n") or die("数据发送失败");
echo $client->recv();

$client->close();
