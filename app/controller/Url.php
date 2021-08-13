<?php

namespace app\controller;
use app\BaseController;
use think\facade\Db;

class Url extends BaseController
{
    public function index()
    {
        $u = request()->route('u');//接收 参数u 赋值给变量u
//        print_r($u);
        /*Route::get(':s','index/index');获取在 http://192.168.133.131/1111 根URL ho后面的值传到对应的方法下,我的是Index/index 方法*/
        if(empty($u)){
            return json(['code'=>0,'status'=>1,'msg'=>'Url is Null','data'=>'']);
        }
        $whe = $u;
        $long_url = Db::name('links')->where('link','=',$whe)->select();
        if(count($long_url)){
            $longurl = $long_url[0]['url'];
            if($long_url) {
                return "<script>location.href='" . $longurl . "'</script>";
            }
        }
        return json(['code'=>0,'status'=>1,'msg'=>'Url is Unavailabel','data'=>'']);

    }
}