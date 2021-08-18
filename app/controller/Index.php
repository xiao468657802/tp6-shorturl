<?php
namespace app\controller;
use app\BaseController;
use think\facade\Db;
use think\Request;
//use think\View;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
//       $s = request()->route('s');
//       print_r($s);
        /*Route::get(':s','index/index');获取在 http://192.168.133.131/1111 根URL ho后面的值传到对应的方法下,我的是Index/index 方法*/
//        if(empty($s)){
//            return json(['code'=>0,'status'=>1,'msg'=>'Url is Null','data'=>'']);
//        }
//        $whe = ['short'=>$s];
//        $long_url = Db::name('links')->where('link','=',$whe['short'])->select();
//        if(count($long_url)){
//            $longurl = $long_url[0]['url'];
//            if($long_url) {
//                    return "<script>location.href='" . $longurl . "'</script>";
//            }
//        }
//        return json(['code'=>0,'status'=>1,'msg'=>'Url is Unavailabel----------------','data'=>'']);
    return View::fetch('api/index');
    }

    public function hello($name = 'ThinkPHP6')
    {

        $this->controllerName;
        return 'hello,' . $name;
    }

}
