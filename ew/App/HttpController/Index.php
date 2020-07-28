<?php
namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller
{
    function index()
    {
        // TODO: Implement index() method.
         $str = iconv('utf-8','GBK','兄弟，你能给面子我很高兴');
        $this->response()->write($str);
    }
}
