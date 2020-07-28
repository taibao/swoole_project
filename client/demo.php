<?php
  //服务器代码

  //创建websocket服务器
  $ws = new swoole_websocket_server("0.0.0.0",9502);

  session_start();

  //on 函数 open message close
  // open情况
  $ws->on('open',function($ws,$request){
    echo "新用户 $request->fd 加入 \n";
    $_SESSION['fd'][$request->fd]['id'] = $request->fd; //设置用户ID
    $_SESSION['fd'][$request->fd]['name'] = '匿名用户'; //设置用户名
  });

  //message
  $ws->on('message',function($ws,$request){
      $msg = $_SESSION['fd'][$request->fd]['name'].":".$request->data."\n";
      if(strstr($request->data,"#name#")){
        //设置用户昵称
        $_SESSION['fd'][$request->fd]['name'] = str_replace("#name#","",$request->data);
      }else{
        //进行用户信息发送
        //发送到每一个客户端
        print_r($_SESSION);
        foreach ($_SESSION['fd'] as $i) {
          $ws->push($i['id'],$msg);
          echo $msg;
        }
      }
  });

  //close
  $ws->on('close',function($ws,$request){
    echo "客户端-{$request} 断开连接 \n" ;
    unset($_SESSION['fd'][$request]); //清除连接仓库
  });

  $ws->start();
