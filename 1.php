<?php

  $host = '0.0.0.0'; //代表监听全部的ip
  $port = 9501;
  $serv = new swoole_server($host,$port);//多进程方式

  /*
  *$event:
  *connect:连接
  *receive:接受
  *close:关闭
  */

$serv->on('connect',function($serv,$fd){
  echo "建立连接";
});

$serv->on('receive',function($serv,$fd,$from_id,$data){
  echo "接收到数据\n";
  var_dump($data);
});

$serv->on('close',function($serv,$fd){
  echo "连接关闭";
});

$serv->start();
