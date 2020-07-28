<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 9:43
 */
    //tcp 协议
    $server =  new  Swoole\Server("0.0.0.0",9800); //创建server对象

//    $server->set([
//        'heartbeat_idle_time'=>10,//连接最大的空闲时间
//        'heartbeat_check_interval'=>3,//服务器定时检查
//        'worker_num'=>2,//设置进程
//        'open_eof_check' => true, //打开eof检测
//        'package_eof' => "\r\n", //设置eof
//        'open_eof_split' => true //开启自动拆分
//    ]);

    //固定包头加包体
    $server->set([
        'worker_num'=>1, //设置进程
        'open_length_check' => 1,
        'package_length_type' => "N", //设置包头的长度
        'package_length_offset' => 0, //包长开始位置
        'package_body_offset' => 4,  //包体从第几个字节开始计算
        'package_max_length' => 1024 * 1024 * 3,
        'buffer_output_size'=>1024 * 1024 * 3, //配置输出缓冲区的大小
    ]);

    //监听事件,连接事件
    $server->on('connect', function ($server ,$fd) {
        echo "新的连接进入:{$fd}" . PHP_EOL;
    });

    //消息发送过来,接收发送方参数
    $server->on('receive',function(swoole_server $server, int $fd,int $reactor_id, string $data){
        $info = unpack("N",$data);
        var_dump('长度',$info);

        //输出到客户端
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->send($fd,$data);
        $server->close($fd);
    });

    //消息关闭
    $server->on('close',function(){
       echo "消息关闭".PHP_EOL;
    });

    //服务器开启
    $server->start();