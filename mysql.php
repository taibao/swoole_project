<?php
  $db = new swoole_mysql();

  $config = [
      'host'=>'192.168.59.131',
      'user'=>'root',
      'password'=>'7758438',
      'database'=>'mysql',
      'charset'=>'utf-8'
  ];

  //连接数据
  $db->connect($config,function($db,$r){
    if($r===false){
      var_dump($db->connect_errno,$db->connect_error);
      die("失败");
    }
    //成功的逻辑
    $sql = 'show tables';
    $db->query($sql,function(swoole_mysql $db,$r){
      if($r===false){
        var_dump($db->error);
        die("操作失败");
      }elseif($r ===true){
        var_dump($db->affected_rows,$db->insert_id);
      }
      var_dump($r);
      $db->close();
    });

  });
