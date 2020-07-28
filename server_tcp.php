<?php

//创建异步tcp客户端

$client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);
//注册链接成功的回调
$client->on('connect',function($cli){
  $cli->send("hello \n");
});

//注册数据接收 $cli ：服务端信息$data数据
$client->on("receive",function($cli,$data){
  echo "data: $data";
});

//注册链接失败
$client->on("error",function($cli){
  echo "失败\n";
});

//注册关闭
$client->on('close',function($cli){
  echo "关闭\n";
});

$client->connect("192.168.59.131",8080,10);
