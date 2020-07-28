<?php
  //全网广播，接收任何人的电话
  $server = new swoole_websocket_server('0.0.0.0',9200);
  $server->on('open',function($server,$req){
    echo "路况良好可以开车";
  });

  $server->on('close',function($server,$frame){
    echo '已经有一位用户跳车了';
  });

  $server->on('message',function($server,$frame){
    $mess = json_decode($frame->data,true);
    if($mess['type']=='video'){
      //送礼物，发表评论,弹幕
      foreach($server->connection_list() as $fd)
      {
        $server->push($fd,json_encode(['data'=>$mess['data'],'type'=>'video']));
      }
    }else if($mess['type']=='mess'){
      foreach($server->connection_list() as $fd)
      {
        $server->push($fd,json_encode(['data'=>$mess['data'],'type'=>'mess']));
      }
    }
    echo '有用户在飙车';
  });

  $server->start();
