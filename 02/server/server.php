<?php

 class Worker{
     //监听socket
     protected $socket = NULL;
     //连接事件回调
     public $onConnect = NULL;
     //接收消息事件回调
     public $onMessage = NULL;
     public function __construct($socket_address) {
        //监听地址+端口
         $this->socket = stream_socket_server($socket_address);
     }

     public function run() {
         
     }

     public function start(){
            while(true){
                $clientSocket = stream_socket_accept($this->socket);//阻塞监听

                if(!empty($clientSocket) && is_callable($this->onConnect)){
                    //触发事件的连接的回调
                    call_user_func($this->onConnect,$clientSocket);
                }

                //从连接当中读取客户端内容
                $buffer =  fread($clientSocket,65535);

                //正常读取到数据，触发消息接收事件，响应内容

                $buffer = "大郎吃药了<br/>";
                if(!empty($buffer) && is_callable($this->onMessage)){
                    call_user_func($this->onMessage,$clientSocket,$buffer);
                }

                //连接建立成功触发事件
//         call_user_func($this->onConnect,"参数");
            }
     }




 }



$worker = new Worker('tcp://0.0.0.0:9800');

 //事件
$worker->onConnect = function ($arg) {
        echo '新的连接来了'.$arg.PHP_EOL;
};

//事件回调
/**
 * @param $conn
 * @param $message
 */
$worker->onMessage = function ($conn, $message) {
    //事件回调当中写业务逻辑
    //var_dump($conn, $message);
   //拼装http响应头
    $content = $message;
    $http_resonse = "HTTP/1.1 200 OK\r\n";
    $http_resonse .= "Content-Type: text/html;charset=UTF-8\r\n";
    $http_resonse .= "Connection: keep-alive\r\n"; //保持长链接
    $http_resonse .= "Server: php socket server\r\n";
    $http_resonse .= "Content-length: ".strlen($content)."\r\n\r\n";
    $http_resonse .= $content;
    fwrite($conn, $http_resonse);

};


$worker->start();


