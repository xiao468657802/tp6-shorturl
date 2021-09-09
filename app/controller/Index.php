<?php
namespace app\controller;
use app\BaseController;
use think\facade\Db;
use think\Request;
//use think\View;
use think\facade\View;

class Index extends BaseController
{
    public function index(Request $request)
    {
//        $data = $request->param();
//        print_r($data);
//        print_r($data['u']);
    return View::fetch('api/index');
    }
//    public function pass(){
//        return View::fetch('api/pass');
//    }
    public function hello($name = 'ThinkPHP6')
    {

        $this->controllerName;
        return 'hello,' . $name;
    }

}
