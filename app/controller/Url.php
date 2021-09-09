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
        if(empty($u)){
            return json(['code'=>0,'status'=>1,'msg'=>'Url is Null','data'=>'']);
        }
        $whe = $u;
        $passurl = Db::name('links')->where('link','=',$whe)->find();
        $long_url = Db::name('links')->where('link','=',$whe)->select();
        if(count($long_url)){
            $hits = ['hits'=>$long_url[0]['hits']+1];//增加1次访问
            $hitsupdate = Db::name('links')->where('link','=',$whe)->update($hits);
            if(!empty($passurl['pass'])){  //有密码的跳验证密码
                return View::fetch('api/pass',[
                    'link'=> $passurl['link'],
                ]);
            }
            $longurl = $long_url[0]['url'];
            if($long_url) {
                //return "<script>location.href='" . $longurl . "'</script>";
                header("Location: ". $longurl);  //没得直接跳
            }
        }
        return json(['code'=>0,'status'=>1,'msg'=>'Url is Unavailabel','data'=>'']);
    }
}