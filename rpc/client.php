<?php
class client{
    protected $ip;
    protected $port;
    protected $serviceName;

    public function __construct($ip,$port){
      $this->ip = $ip;
      $this->port=$port;
    }

    public function __call($name,$arguments){
      if($name=="service"){
        return $this;
      }
      $client=new swoole\client(SWOOLT_SOCK_TCP); //异步client
      
    }
}
