<?php

  //绑定端口，监听ip地址提供服务，9502
  $server = new swoole_server('0.0.0.0',9502); //tcp服务

  //设置参数
  $server->set([
    'worker_num'=>4 //进程合理数CPU的1~4倍
  ]);

  //绑定事件，监听客户端事件发送
  $server->on('receive',function(){
    echo '有客户端发送数据过来了';
  });

//常驻内存


  //启动服务器
  $server->start();
