<?php

  $host = '0.0.0.0'; //代表监听全部的ip
  $port = 9501;
  $ws = new swoole_websocket_server($host,$port);//服务器方式

  //on
  //open 建立连接$ws服务器,$request:客户端信息
  $ws->on('open',function($ws,$request){
    var_dump($request);
    $ws->push($request->fd,"welcome \n");
  });

  //message 接收信息
  $ws->on('message',function($ws,$request){
    echo "Message:$request->data";
    $ws->push($request->fd,"get it message");
  });


  //close 关闭
  $ws->on('close',function($ws,$request){
    echo "close\n";
  });


  $ws->start();
