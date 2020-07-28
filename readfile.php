<?php

//执行swoole_async_readfile swoole4.3已移除所有异步模块
swoole_async_readfile(__DIR__."/1.txt",function($filename,$content){
  echo "$filename $content";
});
