<?php
$client = new swoole_client(SWOOLT_SOCK_TCP); //异步client
$client->connect('123.56.217.62',9588); //连接服务器 1-65535

/*
  *rpc通信自定义协议
*/
