<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 9:43
 */
    //tcp 协议
    $server =  new  Swoole\Server("0.0.0.0",9800); //创建server对象

    $server->set([
        'worker_num'=>1,//设置进程
        'heartbeat_idle_time'=>10, //连接的最大空闲时间
        'heartbeat_check_interval'=>3 //服务器的定时检查
    ]);

    //监听事件,连接事件
    $server->on('connect',function($server,$fd){
        echo "新的连接进入{$fd}".PHP_EOL;
    });

    //消息发送过来,接收发送方参数
    $server->on('receive',function($server, $fd, $reactor_id, $data){
        echo "消息发送过来：".$fd.PHP_EOL;

        //服务端定时器


        echo "来自客户端{$fd}的消息:".$data.PHP_EOL;
        $server->send($fd,"我是服务端".PHP_EOL);
    });

    //消息关闭
    $server->on('close',function(){
       echo "消息关闭".PHP_EOL;
    });

    //服务器开启
    $server->start();