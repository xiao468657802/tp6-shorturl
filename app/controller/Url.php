<?php

namespace app\controller;
use app\BaseController;
use app\Request;
use think\facade\Db;
use think\facade\View;

class Url extends BaseController
{
    public function index(Request $request)
    {
        $u = request()->route('u');//接收 参数u 赋值给变量u
        /*Route::get(':s','index/index');获取在 http://192.168.133.131/1111 根URL ho后面的值传到对应的方法下,我的是Index/index 方法*/
        if(empty($u)){
            return json(['code'=>0,'status'=>1,'msg'=>'Url is Null','data'=>'']);
        }
        $whe = $u;
        $passurl = Db::name('links')->where('link','=',$whe)->find();
        if(!empty($passurl['pass'])){
            return View::fetch('api/pass',[
                'link'=> $passurl['link'],

            ]);
        }
        $long_url = Db::name('links')->where('link','=',$whe)->select();
        if(count($long_url)){
            $longurl = $long_url[0]['url'];
            if($long_url) {
                //return "<script>location.href='" . $longurl . "'</script>";
                header("Location: ". $longurl);
            }
        }
        return json(['code'=>0,'status'=>1,'msg'=>'Url is Unavailabel','data'=>'']);
    }
}