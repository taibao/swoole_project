<?php

  $host = '0.0.0.0'; //代表监听全部的ip
  $port = 9501;
  $serv = new swoole_http_server($host,$port);//服务器方式

  /**
  *$request:请求信息
  *$response ：返回信息
  */
  $serv->on('request',function($request,$response){
    var_dump($request);
    //设置返回头信息
    $response->header("Content-Type","text/html;charset=utf-8");
    //发送信息
    //通过浏览器返回信息
    $response->end("hello world ".rand(100,999));
  });

  // $serv->on('receive',function($serv,$fd,$from_id,$data){
  //   echo "接收到数据\n";
  //   var_dump($data);
  // });
  //
  // $serv->on('close',function($serv,$fd){
  //   echo "连接关闭";
  // });

  $serv->start();
