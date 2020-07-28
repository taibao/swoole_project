<?php

//执行dns查询

swoole_async_dns_lookup("www.baidu.com", function($host, $ip){
    echo "{$host} : {$ip}\n";
});
