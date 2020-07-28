<?php

//进程间通信


  $workers = [];
  $worker_num = 2;

//批量创建进程完成

  for($i=0;$i<$worker_num;$i++){
    //使用管道通信
    $process = new swoole_process("doProcess",false,false);
    $process->useQueue(); //开启队列，类似于全局函数

    $pid = $process->start();
    $workers[$pid] = $process;
  }

  //进程执行函数
  function doProcess(swoole_process $process){
    $recv = $process->pop(); //8192
    echo "从主进程获取到的数据： $recv \r\n";
    sleep(5);
    $process->exit(0);
  }

//主进程 向子进程添加数据
foreach ($workers as $pid => $process) {
  $process->push("hello 子进程 $pid \r\n");
}

//等待子进程结束 回收资源
for($i=0;$i<$worker_num;$i++){
  $ret = swoole_process::wait(); //等待执行完成
  $pid = $ret['pid'];
  unset($workers[$pid]);
  echo "子进程 $pid \n";
}
