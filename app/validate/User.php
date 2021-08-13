<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     * g规则验证器 1
     *   require|chsDash   不能为空   unique:user 不能与库内重复
     *  require|min:6'  6 为位数
     * require|email 格式正确
     */
    protected $rule = [
        'username|用户名' => 'require|chsDash|unique:user',
        'password|密码'=>'require|min:6',
        'email|邮箱'=>'require|email|unique:user'

    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
    protected $scene = [
        'edit' => ['email']
    ];
}
