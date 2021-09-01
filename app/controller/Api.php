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
        /*api 请求 GET
http://192.168.133.131/Api/?url=http://192.168.133.131:8888/site
---17点46分*/
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
        $longUrl = $dataarray['url'];

        $checkon = Db::name('users')->where('id','=','1')->find();
//        print_r($checkon);
        if($checkon['checkon'] == 'on'){
            $seldata= Db::name('links')->where('url','=',"$longUrl")->select();
            if (is_object($seldata)) {  ///单条链接重复生成短链开关
                $selarray = array_values((array)$seldata);
                if(!empty($selarray[0])){
                    $shortlink= $selarray[0][0]['link'];
                    $hostarr = $_SERVER['HTTP_HOST'];
                    $httphost = [ 'data' => $_SERVER['REQUEST_SCHEME'].'://'.$hostarr];
                    $dataarray=['link'=>$httphost['data'].'/u/'.$shortlink];
                    return $this->create($dataarray,'success',200);
                }
            }
        }

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
            $shortlink= $dataarray['link'];
            $hostarr = $_SERVER['HTTP_HOST'];
            $httphost = [ 'data' => $_SERVER['REQUEST_SCHEME'].'://'.$hostarr];
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
