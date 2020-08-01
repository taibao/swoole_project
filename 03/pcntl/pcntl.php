<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/1
 * Time: 18:33
 */

    $a = 1;
    $ppid = posix_getppid(); //得到当前进程id
    echo $ppid.PHP_EOL;

    for($i=0;$i<5;$i++){
        $pid = pcntl_fork(); //创建成功会返回子进程id
        if($pid < 0){
            exit("创建失败了");
            exit("创建失败了");
        }else if($pid > 0){
            $a =2 ;
            //父进程空间，返回子进程id
            echo "子进程id:".$pid.PHP_EOL;
        }else {
            //返回为0子进程空间
            //子进程创建成功
            echo $pid . PHP_EOL;
            sleep(20);
        }
    }

