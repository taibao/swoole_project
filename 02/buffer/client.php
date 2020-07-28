<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 14:50
 */

//粘包数据
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

//客户端发包 固定包头加包体
$client->set([
    'open_length_check' => 1,
    'package_length_type' => "N", //设置包头的长度
    'package_length_offset' => 0, //包长开始位置
    'package_body_offset' => 4,  //包体从第几个字节开始计算
    'package_max_length' => 1024 * 1024 * 3
]);

//发数据
$client->connect("127.0.0.1",9800);

//不要在客户端或者服务端没有确认情况下，发送多次消息
//一次发送大量的数据，拆分小数据
$body = json_encode(str_repeat('a',1024*1024*2));

//创建包头
$header =  pack("N",strlen($body));  //4字节无符号网络字节序
//包头+包体
$data = $header.$body;
$client->send($data);

var_dump(strlen($client->recv())); //接收服务端消息
var_dump(strlen($client->recv())); //接收服务端消息
var_dump(strlen($client->recv())); //接收服务端消息

$client->close();