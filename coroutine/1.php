<?php
  use Swoole\Coroutine as Co;

  //创建一个协程,了解到协程的调度模式，跟进程调度模式，消耗的成本
//
// go(function(){
//   Co::sleep(1);//休眠一秒
//
//   //swoole协程执行时，会保存当前进程执行的状态，并且不阻塞程序执行
//   //查询mysql查询得到结果(等待了3秒)
//  pcntl_fork();
//
//   echo "taibao \n";
// });
//
// echo "真\n";
//
// go(function(){
//   //协程执行空间
//   Co::sleep(3);
//   echo "可爱 \n";
// });
//
// go(function(){
//   //协程执行空间
//   Co::sleep(5); //总共执行完成花了5秒，不阻塞
//   echo "可爱 \n";
// });

//异步通知执行函数
//协程适合场景

$n =  4;
for($i=0;$i<$n;$i++){
go(function() use($n){
    Co::sleep(1);
});
}

//协程能替代进程吗
//不能
