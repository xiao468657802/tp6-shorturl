<?php
declare (strict_types = 1);

namespace app\controller;

//use app\model\User as UserModel;
use app\model\Links as LinksModel;
//use app\validate\User as UserValidate;
use app\validate\Links as Linksvalidate;
use think\facade\Db;
use think\exception\ValidateException;
//use think\facade\Validate;
//use think\Request;
//use think\facade\Request;
use think\Request;

class Links extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
            $check = $request->checkToken('__token__',$request->param());
            if(false === $check)
            {
                //throw new ValidateException('invalid token');
                return json(['code' => 0, 'status' => 0, 'msg' => '无效token,请 按 F5刷新页面', 'data' => '']);
            }
            $paramdata = \think\facade\Request::instance()->param();
            $page = (int)$paramdata['page'];
            $limit = (int)$paramdata['limit'];

            $data = Db::name('links')->page($page,$limit)->select();//->order('id ')
            $count = Db::name('links')->count();
    //        $data = LinksModel::select();
    //        return $this->create($data,$data->isEmpty()?'Error':'ok',$code= 0);
            return json(['data'=>$data,'code'=>0,'msg'=>'ok','page'=>$page,'limit'=>$limit,'count'=>$count]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        ///**http://192.168.133.131/user/?username=xiaosusu&password=123456&email=susu@163.com
        //        POST
        //         */Request $request, $id
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
            validate(LinksValidate::class)->check($dataarray);}
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
            return $this->create($dataarray,'success',200);
        }
    }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
//        //http://192.168.133.131/user/19    // GET qing请求
//        //判断id是否整型
//        $data = LinksModel::select();
//        return $this->create($data,$data->isEmpty()?'unavailable':'success');
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
        //  更新
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        /**http://192.168.133.131/user/ddd
         *http://192.168.133.131/user/ddd
         * 请求方法  DELETE
         */                          //同过api请求删除,不建议开通
//        if(!Validate::isInteger($id)){
//            return $this->create([],'id参数不合法',400);
//        }
//        //delete
//        try {
//            LinksModel::find($id)->delete();
//            return $this->create([],'删除成功',200);
//        }catch (\Error $e){
//            return $this->create([],'无法删除错误',400);
//        }
        return json(['code'=>0,'status'=>1,'msg'=>'error','data'=>'']); //如开通请注释这行
    }
    public function select()
    {  //cha查询接口
//        $paramdata = Request::instance()->param();
//        $page = (int)$paramdata['page'];
//        $limit = (int)$paramdata['limit'];
//        $data = Db::name('links')->page($page,$limit)->select();//->order('id ')
//        $count = Db::name('links')->count();
//        return json(['data'=>$data,'code'=>0,'msg'=>'ok','page'=>$page,'limit'=>$limit,'count'=>$count]);
    }
    public function addlink(\app\Request $request){
        $data = \request()->param();   // 公用添加

        $datime = date("Y-m-d H:i:s",time());
        $params = ['url'=>$data['url'],'link'=>$data['link'],'pass'=>$data['pass'],'last_visit'=>$datime];  //2 fang法

        if(strlen($params['link'])<=4){
                for($i=1;$i<2;$i++){
                    $params['link'] = $this->generateRandNumberVerificationCode($size = 5);
                }
        }
//                print_r($params);
        $ret= Db::name('links')->insert($params);
        if($ret){
            return json(['code'=>0,'status'=>0,'msg'=>'添加成功','data'=>'']); //pa判断上面ret执行成功返回
        }
        return json(['code'=>0,'status'=>1,'msg'=>'error','data'=>'']);
    }
    public function del(Request $request)
    {
        $data = $request->param();   // 批量页面, 单个删除
        $ret= Db::name('links')->delete($data['id']);
        if($ret){
            return json(['code'=>0,'status'=>0,'msg'=>'删除成功','data'=>'']); //pa判断上面ret执行成功返回
        }
        return json(['code'=>0,'status'=>1,'msg'=>'error','data'=>'']);
    }
    public function edit(Request $request){
        $data = $request->param();   //批量页面 编辑
        $slen = strlen($data['link']);
        if($slen<=4){
//            $slen = count($data['link']);// $slen = strlen($data['link']); ji计算长度
            $data['link'] = $this->generateRandNumberVerificationCode($size = 5);
        }
        $datime = date("Y-m-d H:i:s",time());
        $params = ['url'=>$data['url'],'link'=>$data['link'],'pass'=>$data['pass'],'last_visit'=>$datime];  //2 fang法
//        print_r($params);
        $ret = Db::name('links')->where('id',$data['id'])->update($params);

        if($ret){
            return json(['code'=>0,'status'=>0,'msg'=>'编辑成功','data'=>'']); //pa判断上面ret执行成功返回
        }
        return json(['code'=>0,'status'=>1,'msg'=>'error','data'=>'']);
    }
    public function dels(Request $request){
        $data = $request->param();            //批量删除
        if(empty($data)){
            return json(['code'=>0,'status'=>1,'msg'=>'error or array is empty!','data'=>'']);
        }
        if(empty($data['ids'])) {
         $data = [ 'ids' => 'empty'];
        }
        if(is_array($data['ids'])){
            $slen = count($data['ids']);
        }else{
            $slen = strlen($data['ids']);
        }
        for($i=0;$i<$slen;$i++){
            $data_data = ['id' => $data['ids'][$i]];  //使用相同名的变量,会覆盖原来变量的内容
//            print_r($slen.';2;i=0'.$i.';3 $data_data[id]=365'.$data_data['id'].'$data[ids][$i]=365'.$data['ids'][$i]);
            $ret= Db::name('links')->delete($data_data['id']);  //在一个方法或循环等中,遇到return即结束执行,  结束
        }
        if($ret){
            return json(['code'=>0,'status'=>0,'msg'=>'批量删除成功','data'=>'']); //pa判断上面ret执行成功返回
        }
        return json(['code'=>0,'status'=>1,'msg'=>'error or empty!','data'=>'']);
    }


}
