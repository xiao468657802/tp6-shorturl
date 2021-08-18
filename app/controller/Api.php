<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Links as LinksModel;
use think\Request;
//use app\model\User as UserModel;//use app\validate\User as ApiValidate;
use app\model\Api as ApiModel;

use app\validate\Api as ApiValidate;
use think\facade\Db;
use think\exception\ValidateException;
use think\facade\Validate;
//use think\Request;
class Api extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
//        $data = ApiModel::select();
//        return $this->create($data,$data->isEmpty()?'Error':'ok',$code= 0);
        $data = $request->param();
        if(empty($data['link'])){
            for($i=1;$i<2;$i++){
                $data['link'] = $this->generateRandNumberVerificationCode($size = 5);
            }
        }
        if(empty($data['pass'])){
            for($i=1;$i<2;$i++){
                $data['pass'] = '';
            }
        }
        $datime = date("Y-m-d H:i:s",time());

        $dataarray = ['pass' =>'',
            'last_visit'=> $datime
            ,        'url'=>$data['url']
            ,        'link'=>$data['link']
            ,         'pass'=>$data['pass']];
//        $updatedata = Db::name('links')->where('link','=',$dataarray['link'])->select();
        $findda = Db::name('links')->where('link','=',$dataarray['link'])->find();
        if (empty($findda)){  //判断是否查询到库中存在的
            $dataarray['link'] = $this->generateRandNumberVerificationCode($size = 5);
        }

        try {
            //验证                验证别名                  验证的数据内容
            validate(ApiValidate::class)->check($dataarray);}
            //错误返回
        catch(ValidateException $exception){
            return $this->create([],$exception->getError(),400);
        }
        //写入并返回ID
        $id = LinksModel::create($dataarray)->getData('id');
        //判断是否有值

        if(empty($id)) {
            return $this->create([], '注册失败', 400);
        }else{
//            return $this->create($id,'注册成功',200);
            $shortlink= $dataarray['link'];
            $hostarr = $_SERVER['HTTP_HOST'];

            //print_r($_SERVER); // REQUEST_SCHEME 这个常量可能是取HTTP或https的值
//        print_r($hostarr);  //192.168.133.131
            $httphost = [ 'data' => $_SERVER['REQUEST_SCHEME'].'://'.$hostarr];
//            print_r($dataarray['link']);
            $dataarray=['link'=>$httphost['data'].'/u/'.$shortlink];
            return $this->create($dataarray,'success',200);
        }

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
//        $data = $request->param();
//        if(empty($data['link'])){
//            for($i=1;$i<2;$i++){
//                $data['link'] = $this->generateRandNumberVerificationCode($size = 5);
//            }
//        }
//        if(empty($data['pass'])){
//            for($i=1;$i<2;$i++){
//                $data['pass'] = '';
//            }
//        }
//        $datime = date("Y-m-d H:i:s",time());
//
//        $dataarray = ['pass' =>'',
//            'last_visit'=> $datime
//            ,        'url'=>$data['url']
//            ,        'link'=>$data['link']
//            ,         'pass'=>$data['pass']];
////        $updatedata = Db::name('links')->where('link','=',$dataarray['link'])->select();
//        $findda = Db::name('links')->where('link','=',$dataarray['link'])->find();
//        if (empty($findda)){  //判断是否查询到库中存在的
//            $dataarray['link'] = $this->generateRandNumberVerificationCode($size = 5);
//        }
//
//        try {
//            //验证                验证别名                  验证的数据内容
//            validate(ApiValidate::class)->check($dataarray);}
//            //错误返回
//        catch(ValidateException $exception){
//            return $this->create([],$exception->getError(),400);
//        }
//        //写入并返回ID
//        $id = LinksModel::create($dataarray)->getData('id');
//        //判断是否有值
//
//        if(empty($id)) {
//            return $this->create([], '注册失败', 400);
//        }else{
////            return $this->create($id,'注册成功',200);
//            return $this->create($dataarray,'success',200);
//        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
