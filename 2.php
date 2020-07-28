<?php

  $host = '0.0.0.0'; //代表监听全部的ip
  $port = 9502;
  $serv = new swoole_server($host,$port,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);//多进程方式
  //监听数据接收的事件
  /*
  *
  */
$serv->on('packet',function($serv,$data,$fd){
  //发送数据到相应的数据库。反馈信息
  $serv->sendto($fd['address'],$fd['port'],"Server:$data");
  var_dump($fd);
});

$serv->start();
