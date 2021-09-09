<?php
namespace app\controller;
use think\Response;

class Base
{
    protected function create($data,string $msg= '', int  $code = 200,$type = 'json')
    {
        $result =[
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return Response::create($result,$type);
    }
    public function generateRandNumber(int $size = 4)
    {
        if ($size <= 0 || empty($size) || !isset($size)) {
            $size = 4;
        }

//验证码内容
        $code_array = array(
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
            ,'A','B','C','D','E','F','G','H','I','G','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        );

        $random_keys = array();
        for ($i = 0; $i < $size; $i++) {
            $keys = array_rand($code_array, 1);

            array_push($random_keys, $code_array[$keys]);
        }

//数组转成字符串
        $verification_code = implode('', $random_keys);

        return $verification_code;

    }
    public function check_token()
    {

    }

}