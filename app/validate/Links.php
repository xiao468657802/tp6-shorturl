<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class Links extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * require|chsDash   不能为空   unique:user 不能与库内重复
     *  require|min:6'  6 为位数
     * require|email 格式正确
     * 我们通常会有这样的应用场景，比如在操作用户表(User)时，我们希望username和nickname这两个字段是唯一的，所以在新增和更新时就要对他的唯一性做验证，内置的unique规则在新增时验证没有任何问题，但是在更新时就会碰到如果提交数据时nickname没有被修改（username通常一旦注册不能修改），那么验证也会通不过，提示nickname已经存在。搜索发现有人也碰到这个问题，传送门：http://www.thinkphp.cn/topic/47768.html，随即我试着参照修改，
     *
     * @var array
     */
    protected $rule = [
        'link|link' => 'require|chsDash|unique:links|require|min:5|require|max:5'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
