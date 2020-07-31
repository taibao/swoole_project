<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 9:43
 */
    //tcp 协议
    $server =  new  Swoole\Server("0.0.0.0",9800); //创建server对象

    //固定包头加包体
    $server->set([
        'worker_num'=>1, //设置进程
        'open_length_check' => 1,
        'package_length_type' => "N", //设置包头的长度
        'package_length_offset' => 0, //包长开始位置
        'package_body_offset' => 4,  //包体从第几个字节开始计算
        'package_max_length' => 1024 * 1024 * 2,
    ]);

    //绑定事件
    $server->on("Start" ,function(){
        var_dump(1);
        //设置主进程名称
        swoole_set_process_name("server-process:master");
    });

    //服务关闭的时候触发
    $server->on("shutdown",function(){
        //设置主进程的名称
        swoole_set_process_name("server-process:master");
    });

    //当管理进程启动时调用它
    $server->on('ManagerStart',function(){
        var_dump(2);

        swoole_set_process_name("server-process:manager");
    });

    $server->on('WorkerStart',function($server,$workerId){
       swoole_set_process_name("server-process:worker");
        var_dump(3);
    });



//监听事件,连接事件
$server->on('connect', function () {
    echo "新的连接进入" . PHP_EOL;
});

//消息发送过来,接收发送方参数
$server->on('receive',function($server, $fd, $reactor_id, $data){
    //服务端解包
    $info = unpack('N',$data);
    var_dump("长度",$info[1]);
    var_dump(substr($data,4));
});

//消息关闭
$server->on('close',function(){
    echo "消息关闭".PHP_EOL;
});

//服务器开启
$server->start();


//服务器开启
$server->start();