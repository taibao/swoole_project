<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/12
 * Time: 14:50
 */

//粘包数据
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

// （fd+id） 识别身份
//发数据
$client->connect("127.0.0.1",9800);

//for($i=0;$i<10;$i++){
//    $client->send("123456\r\n");
//}

//一次发送大量的数据，拆分小数据
//$body   = json_encode(str_repeat('a',1*1024*1024));

$body = "hello";
//创建包头
$header =  pack("N",strlen($body));  //4字节无符号网络字节序
//包头+包体
$data = $header.$body;
$client->send($data);
//echo "来自服务端的消息:".$client->recv(); //接收消息