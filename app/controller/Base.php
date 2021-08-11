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
    public function generateRandNumberVerificationCode(int $size = 4)
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
    //generateRandNumberVerificationCodeImg
//    public function index($code = '',$size='4', $width = 129, $height = 38)
//    {
//        if ($size <= 0 || empty($size) || !isset($size)) {
//            $size = 4;
//        }
//
////验证码内容
//        $code_array = array(
//            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
//        );
//
//        $random_keys = array();
//        for ($i = 0; $i < $size; $i++) {
//            $keys = array_rand($code_array, 1);
//
//            array_push($random_keys, $code_array[$keys]);
//        }
//
////数组转成字符串
//        $verification_code = implode('', $random_keys);
//
//        $code = $verification_code;
//        if (empty($code) || !isset($code)) {
//            return false;
//        }
//
//        $file_name = 'randimg_id_' . '1' . '.png';
////域名
//        $domain_name = 'randimg_id_' . '1' . '.png';
//
//        $img = imagecreatetruecolor($width, $height);
//        $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
//        $green = imagecolorallocate($img, 0x00, 0xFF, 0x00);
//        $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
//        imagefill($img, 0, 0, $white);
//
//        imagestring($img, 5, 22, 12, $code, $black);
////加入噪点干扰
//        for ($i = 0; $i < 100; $i++) {
//            imagesetpixel($img, rand(0, $width), rand(0, $width), $black);  //imagesetpixel — 画一个单一像素，语法: bool imagesetpixel ( resource $image , int $x , int $y , int $color )
//            imagesetpixel($img, rand(0, $width), rand(0, $width), $green);
//        }
//
////输出验证码
////        header("content-type: image/png");
//        imagepng($img, $file_name);  //保存图片
//        imagepng($img);
//        imagedestroy($img);  //图像处理完成后，使用 imagedestroy() 指令销毁图像资源以释放内存，虽然该函数不是必须的，但使用它是一个好习惯。
//
//        return $code;
//        //echo "<img src='/randimg_id_1.png' alt='验证码'>";
//
//    }
}