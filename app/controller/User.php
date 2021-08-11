<?php
declare (strict_types = 1);

namespace app\controller;
use app\model\User as UserModel;
//use think\console\command\make\Validate;
use think\exception\ValidateException;
use think\facade\Validate;
use think\Request;
use think\Response;
use app\validate\User as UserValidate;
class User extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //return UserModel::select();  http://192.168.133.131/user/  GET zhu主页请求
        //return Response::create([1,2,3],'json');
        $data = UserModel::field('id,username')->select();
        return $this->create($data,$data->isEmpty()?'unavailable':'success');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        /**http://192.168.133.131/user/?username=xiaosusu&password=123456&email=susu@163.com
        POST
         */
        $data = $request->param();
//        print_r($data);
        try {
            //验证
            validate(UserValidate::class)->check($data);}
        //错误返回
            catch(ValidateException $exception){
                return $this->create([],$exception->getError(),400);
            }
//密码
            $data['password'] = sha1($data['password']);
        //写入并返回ID
        $id = UserModel::create($data)->getData('id');
        //判断是否有值
        if(empty($id)) {
            return $this->create([], '注册失败', 400);
        }else{
            return $this->create($id,'注册成功',200);
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
        //http://192.168.133.131/user/19    // GET qing请求
        //判断id是否整型
        if (!Validate::isInteger($id)) {
            return $this->create([], 'id参数不合法~', 400);
        }

        //获取数据
        $data = UserModel::field('id,username,gender,email')->find($id);

        //判断是否有值
        if (empty($data)) {
            return $this->create([], '无数据', 204);
        } else {
            return $this->create($data, '数据请求成功1', 200);
        }
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
        /**http://192.168.133.131/user/$id?email=labixiaoxin@163.com
        http://192.168.133.131/user/19?email=labixiaoxin@163.com
         PUT  方法
         */
        //echo 'update';
        $data = $request->param();
        //
        try {
            validate(UserValidate::class)->scene('edit')->check($data);}
            //错误返回
        catch(ValidateException $exception){
            return $this->create([],$exception->getError(),400);
        }
        //huo获取数据库里的数据
        $updatedata = UserModel::find($id);
//        print_r($updatedata);
//邮箱上修改不可重复
        if($updatedata->email === $data['email']){
            return $this->create([],'修改邮箱与原来一致',400);
        }

        // xiu修改
        $id = UserModel::update($data)->getData('id');
        //p判断是否右值
        if(empty($id)){
            return $this->create([],'x修改失败',400);
        }else{
            return $this->create($id,'修改成功',200);
        }
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
        */
        if(!Validate::isInteger($id)){
            return $this->create([],'id参数不合法',400);
        }
        //delete
        try {
            UserModel::find($id)->delete();
            return $this->create([],'删除成功',200);
        }catch (\Error $e){
            return $this->create([],'无法删除错误',400);
        }
       // dd(UserModel::find($id)->delete());

    }
}
