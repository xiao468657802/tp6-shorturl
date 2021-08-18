<?php
namespace app\controller;
use app\BaseController;
use app\Request;
use think\captcha\facade\Captcha;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Session;
//use think\View;
use think\facade\View;

class Home extends BaseController
{
    public function verify(){
        return Captcha::create();
    }
    public function index()  //k因为public 目录已经有了admin 目录,所以不能再有admin名称的控制器
    {
        return "<script>location.href = '/admin/start/' </script>";
    }
    public function api(Request $request)
    {
//        error_reporting(0);
        $url=$request->param();
        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');

        if ($url['type'] == 'toLong') {
            $long_url = $this->restoreUrl($url['url']);
//            $this->returnResult($long_url);
        } elseif ($url['type'] == 'toShort') {
//            $long_url=urlencode($url['url']);
            if ($url['kind'] == 'isgd') {
                $short_url = $this->get("https://is.gd/api.php?longurl=" . $url['url']);
            } elseif ($url['kind'] == 'unu') {
                $short_url = $this->get("https://u.nu/api.php?action=shorturl&format=simple&url=" . $url['url']);
            } elseif ($url['kind'] == 'tinyurl') {
                $short_url = $this->get("https://tinyurl.com/api-create.php?url=" .$url['url']);
            } elseif ($url['kind'] == 'vwlin') {
                $short_url = $this->get("https://vwlin.cn//api.php?url=" .$url['url']);
            } elseif ($url['kind'] == 'local') {
                $short_url = $this->get("http://192.168.133.131/Api/?url=".$url['url']);
            } else {
                $short_url = '';
            }
        } else {
            $short_url = '';
        }
        $short = ['code' => explode(",",$short_url)[0],
            'shorturl' =>explode(",",$short_url)[2] ];
      if(!empty($short)){
            $res_data=['url'=>$short['shorturl']
                ,'code'=>200];
        } else {
            $res_data['code'] = 400;
            $res_data['msg'] = '获取失败';
        }
//      $res_json
//        return (json($res_data,JSON_UNESCAPED_UNICODE));
        exit(json_encode($res_data,JSON_UNESCAPED_UNICODE));
    }

    public function setuser(Request $request)   /* 获取用户名等信息 */
    {
//        var_dump(boolval($this->checkdtoken($request,$request->param())));
        if(!$this->checkdtoken($request,$request->param())) {
            $data = Db::name('users')->select();
            $ret[0] = [
                'username' => $data[0]['username'],
                'nickname' => $data[0]['nickname'],
                'sex' => $data[0]['sex'],
                'avatar' => $data[0]['avatar'],
                'email' => $data[0]['email'],
                'remarks' => $data[0]['remarks']
            ];
            return json(['code' => 0, 'status' => 0, 'msg' => 'success', 'data' => $ret]);
        }
    }
    public function save(Request $request)  /* 修改用户名信息 */
    {
        $tok = $request->param()['access_token'];
        if(empty($tok)){
            return json(['code'=>0,'status'=>0,'msg'=>'Error , 无效token','data'=>'']);
        }
        else {
            $data = $request->param();
            //unset($data['access_token']);
            $dataa = [
                'username' => $data['username'],
                'nickname' => $data['nickname'],
                'sex' => $data['sex'],
                'avatar' => $data['avatar'],
                'email' => $data['email'],
                'remarks' => $data['remarks']
            ];
            $res = Db::name('users')->where('id', 1)->update($dataa);
            if ($res) {
                return json(['code' => 0, 'status' => 0, 'msg' => 'success', 'data' => '']);
            }
            return json(['code' => 0, 'status' => 1, 'msg' => 'Error ,请重试', 'data' => '']);
        }
    }
    public function spwd(Request $request)
    {
        $tok = input('post.__token__', '', 'trim');  //tijiao 1
        if(empty($tok)){
            return json(['code'=>0,'status'=>0,'msg'=>'Error , 无效token','data'=>'']);
        }
        else {
            $check = $request->checkToken('__token__', $request->param());
            if (false === $check) {
                //throw new ValidateException('invalid token');
                return json(['code' => 0, 'status' => 0, 'msg' => '无效token,请 按 F5刷新页面', 'data' => '']);
            }
            $dataa = Db::name('users')->select(); /* 修改密码的方法 一个类里的一个函数称为方法*/
            $data = $request->param();
            if ($dataa[0]['password'] == md5(md5($data['oldPassword']) . 'paswd')) {
                $pwd = ['password' => md5(md5($data['password']) . 'paswd')];
                $res = Db::name('users')->where('id', 1)->update($pwd);
                if ($res) {
                    return json(['code' => 0, 'status' => 0, 'msg' => 'success', 'data' => '']);
                }
                return json(['code' => 0, 'status' => 1, 'msg' => 'Error ,请输入有效密码', 'data' => '']);
            }
            return json(['code' => 0, 'status' => 1, 'msg' => 'Error ! 当前密码不正确', 'data' => '']);
        }
    }
    /* 下面重置密码模块或方法,不用的话尽量选择注释掉  home.php/respwd*/
    public function respwd(Request $request)
    {
        $tok = input('post.__token__', '', 'trim');  //tijiao 1
        if(empty($tok)){
            return json(['code'=>0,'status'=>0,'msg'=>'Error , 无效token','data'=>'']);
        }
        else {
            $check = $request->checkToken('__token__',$request->param());
            if(false === $check)
            {
                //throw new ValidateException('invalid token');
                return json(['code' => 0, 'status' => 0, 'msg' => '无效token,请 按 F5刷新页面', 'data' => '']);
            }
            //ef744145bbc6f8ecdf5e27cfdbaed823   为123456的md5加密 密文
            $data = ['password' => 'ef744145bbc6f8ecdf5e27cfdbaed823'];
            $respwd = md5(md5($data['password']) . 'paswd');
            $res = Db::name('users')->where('id', 1)->update($data);
            if ($res) {
                return json(['code' => 0, 'status' => 0, 'msg' => 'success', 'data' => '']);
            }
            return json(['code' => 0, 'status' => 1, 'msg' => 'Error !! 重置错误或当前为初始密码', 'data' => '']);
        }
    }
    /*上面重置密码模块或方法,不用的话尽量选择注释掉  home.php/respwd */
    /* 下面自动获取 域名   */
    public function httphost(){
        $hostarr = $_SERVER['HTTP_HOST'];
//        print_r($hostarr);  //192.168.133.131
        $httphost = [ 'data' => 'http://'.$hostarr];
        if($httphost){
            return json(['code'=>0,'status'=>0,'msg'=>'success','data'=>$httphost]);
        }
        return json(['code'=>0,'status'=>1,'msg'=>'Error !! ','data'=>$httphost]);
    }

    public function token()
    {
        $data = request()->buildToken('__token__', 'sha1');
        // return View::fetch('/token/index');
        return json(['code'=>0,'status'=>0,'msg'=>'success','data'=>$data]);
    }
}