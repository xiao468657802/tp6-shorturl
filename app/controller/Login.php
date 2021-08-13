<?php


namespace app\controller;
use app\BaseController;
// think\facade\View;
use think\facade\Db;
use think\Response;
use think\route\dispatch\Controller;

class Login extends BaseController
{
    public function login()
    {
        $captchaa = input('post.vercode','','trim');
//        echo $captchaa;
        $page = Db::name('users')->select();
        //y验证码模块
//        if(!captcha_check(input('post.vercode'))){
//            return json(['code'=>0,'status'=>1,'msg'=>'验证码错误']);;
//        }
        //下面验证密码账号模块
        if ($this->request->isPost()) {
            // 处理登陆请求
            $username = input('post.username', '', 'trim');
            $password = input('post.password', '', 'trim');
            $ret = Db::name('users')->where('username' ,'=',$username)->select();
            $data = ['access_token'=> 'c276e61cd13ad99fc650e6908c7e5e65b63d2f32185ecfed6b801ee3fbdd5c1b'];
            // print_r($data);
            if ($username == $page[0]['username'] && md5(md5($password).'paswd') == $page[0]['password']) {
                session('admin_id', 1);
                if($page){
                    return json(['code'=>0,'status'=>0,'msg'=>'success','data'=>$data]); //pa判断上面ret执行成功返回
                }

                return json(['code'=>0,'status'=>1,'msg'=>'用户名或密码错误','access_token'=>'']);
            } else {
                return json(['code'=>0,'status'=>1,'msg'=>'用户名或密码错误','access_token'=>'']);
                //return '<br>用户名或密码错误&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">返回登陆页面</a>';
            }
        } else {
            // 登录页面显示
            return view('/login');
        }

    }
    public function index(){
        //  已登录访问登录页面重定向到首页
        //if (session('?admin_id')) return redirect('/index');
        $page = Db::name('users')->select();

        if ($this->request->isPost()) {
            // 处理登陆请求
            $username = input('post.username', '', 'trim');
            $password = input('post.password', '', 'trim');
            $ret = Db::name('user')->where('username' ,$username)->select();
            echo $ret;
            if ($username == $page[0]['username'] && $password == $page[0]['password']) {
                session('admin_id', 1);
                if($ret){
                    return json(['code'=>0,'status'=>0,'msg'=>'添加成功','data'=>'']); //pa判断上面ret执行成功返回
                }
                return json(['code'=>0,'status'=>1,'msg'=>'error','data'=>'']);
            } else {
                return '<br>用户名或密码错误&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">返回登陆页面</a>';
            }
        } else {
            // 登录页面显示
            return view();
        }
    }
}

