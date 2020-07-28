<?php

//触发函数 异步执行 达到10次停止
swoole_process::signal(SIGALRM,function(){
  static $i =0;
  echo "$i \n";
  $i++;
  if($i>10){
    swoole_process::alarm(-1); //清除定时器
  }
});

//定时信号
swoole_process::alarm(100*1000);
