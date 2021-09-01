<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;
//use app\Request;
//use think\Request;
/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }
    public function checkdtoken(Request $request,array $token_access)
    {
        $tok = $token_access;//use app\Request;
        if(empty($tok)){
            return json(['code'=>0,'status'=>0,'msg'=>'Error , 无效token','data'=>'']);
        }
        else {
            $check = $request->checkToken('__token__', $tok);
            if (false === $check) {
                //throw new ValidateException('invalid token');
                return json(['code' => 0, 'status' => 0, 'msg' => '无效token,请 按 F5刷新页面', 'data' => '']);
            }
        }
    }

    //post
    public function send_post2($host,$port,$urlPage,$postData){
        $errno = '';
        $errstr = '';
        $length = strlen($postData);
        $fp = fsockopen($host,$port,$errno,$errstr,120) or exit($errstr."--->".$errno);
        //构 造post请求的头
        $header = "POST $urlPage HTTP/1.1\r\n";
        $header .= "Host:".$host."\r\n";
        $header .= "Referer:".$urlPage."\r\n";
        $header .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length:".$length."\r\n";
        $header .= "Connection:Close\r\n\r\n";
        //添加post的字符串
        $header .= $postData."\r\n";
        //发送post的数据
        fputs($fp, $header);
        $inheader = 1;
        $result = ""; //最终结果
        while (!feof($fp)){
            $line = fgets($fp,1024); // 去除请求包的头只显示页面 的返回数据  (注意fgets  fread($fp,1)最少2个字节起。)
            if($inheader && ($line == "\n" || $line == "\r\n"))
                $inheader = 0;
            if($inheader==0){
                $result .= $line;
            }
        }
        fclose($fp);
        return $result;
    }
    function my_flush(){
        ob_flush();
        flush();
    }

//返回结果
    public function restoreUrl($shortUrl)
    { //还原短网址
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $shortUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0');
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_NOBODY, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        $data = curl_exec($curl);
//        var_dump($data);
        $curlInfo = curl_getinfo($curl);
        curl_close($curl);
//        var_dump($curlInfo);
        if ($curlInfo['http_code'] == 301 || $curlInfo['http_code'] == 302) {
            return $curlInfo['redirect_url'];
        }
        return '';
    }
	public function repost($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://u.nu/api/url/add",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Token SGX4yitHzsEJ",
                "Content-Type: application/json",
            ),
            CURLOPT_POSTFIELDS => '{
    "url": "https://google.com",
    "custom": "google",
    "password": "mypass",
    "domain": "http://goo.gl",
    "expiry": "2020-11-11 12:00:00",
    "type": "splash",
    "geotarget": [{
        "location": "Canada",
        "link": "https://google.ca"
      },
      {
        "location": "United States",
        "link": "https://google.us"
      }
    ],
    "devicetarget": [{
        "device": "iPhone",
        "link": "https://google.com"
      },
      {
        "device": "Android",
        "link": "https://google.com"
      }
    ]
  }',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return $response;
	}
    public function get($url)
    {//get请求
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);

    }//  解决办法二，你可以通过使用curl函数来替代file_get_contents函数，当然你的主机必须支持curl函数。
}
//方法1: 用file_get_contents 以get方式获取内容：
//$url='http://www.51growup.com/';
//$html = file_get_contents($url);
//echo $html;
//
//方法2: 用fopen打开url, 以get方式获取内容
// $fp = fopen($url, 'r'); stream_get_meta_data($fp); while(!feof($fp)) { $result .= fgets($fp, 1024); } echo "url body: $result"; fclose($fp);
//：用file_get_contents函数,以post方式获取url
//$data = array ('foo' => 'bar');
// $data = http_build_query($data);
// $opts = array ( ‘http' => array ( 'method' => 'POST', 'header'=> "Content-type: application/x-www-form-urlencodedrn", "Content-Length: " . strlen($data) . "rn", 'content' => $data ) );
// $context = stream_context_create($opts);
// $html = file_get_contents('http://www.51growup.com/e/admin/test.html', false, $context);
// echo $html;

