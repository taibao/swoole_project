<?php

//执行swoole_async_readfile swoole4.3已移除所有异步模块
swoole_async_writefile(__DIR__."/1.txt","eryer",function($filename){
  echo $filename;
},0);

//要写入的内容为4M
