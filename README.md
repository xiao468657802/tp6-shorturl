ThinkPHP 6.0
===============

> 运行环境要求PHP7.1+，兼容PHP8.0。

[官方应用服务市场](https://market.topthink.com) | [`ThinkAPI`——官方统一API服务](https://docs.topthink.com/think-api)

ThinkPHPV6.0版本由[亿速云](https://www.yisu.com/)独家赞助发布。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持
* 更强大和易用的查询
* 全新的事件系统
* 模型事件和数据库事件统一纳入事件系统
* 模板引擎分离出核心
* 内部功能中间件化
* SESSION/Cookie机制改进
* 对Swoole以及协程支持改进
* 对IDE更加友好
* 统一和精简大量用法

## 安装

~~~
composer create-project topthink/think tp 6.0.*
~~~

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

## 文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

## 参与开发

请参阅 [ThinkPHP 核心框架包](https://github.com/top-think/framework)。

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2020 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)

~~~

~~~

~~~
/*  路由也有顺序, :s 模糊匹配的放最后, 'u/:k' 二级模糊匹配,方倒数第二. 'home' 三级精准匹配最上面精准匹配 */
/* rewrite ^(/u/)(.*)$ /u/$2?k=$1; -http://192.168.133.131/u/dfg45 nginx 规则 在源URL中 /u/为$1,那么第二个(.*)$ 后面的无限匹配为第二个参数
在301 重定向时, 地址为 /u/$2 即可 后面的 ?k=$1 是传的参数,因/u/目录不变,所以$1 用来传参,
在路由接收这里,u/:k为匹配到的地址加传参, 后面的Url/index 为路由跳转的类和具体的方法(页面).---
这里是传参在路由跳转这里不用写'Url/index:k',bur不然会成为 方法不存在:app\controller\Url->indexdfg45(),路由回去找这个类Url里面的方法indexdfg45(),也就是 /url/index/indexdfg45

如果不想开启 重 /u/二级目录跳转路径,将路由注释即可   Route::get('u/:k','Url/index');    */
/*Route::get(':s','index/index');获取在 http://192.168.133.131/1111 根URL ho后面的值传到对应的方法下,我的是Index/index 方法*/

http://192.168.133.131/u/aasd
此条为二级路由,跳转
/u/aasd
不想要从二级匹配注释词句路由
Route::get('u/:k','Url/index');
~~~


~~~
--------------------------测试 v0.1
route/app.php

Route::resource('user','User');
Route::get('links/index','Links/index');
Route::post('links/edit','Links/edit');
Route::post('links/del','Links/del');
Route::post('links/addlink','Links/addlink');
Route::delete('links/delete','Links/delete');
Route::get('links/read','Links/read');
Route::post('links/save','Links/save');
Route::post('links/dels','Links/dels');
Route::get('links/:l','Links/');

//yanz验证码路由
Route::get('/home/captcha','/Home/verify');
Route::get('/home/index','/Home/index');  //家入口路由
Route::get('/home/setuser','Home/setuser'); // 用户管理路由
Route::get('/home/save','/Home/save');
Route::get('/home/spwd','/Home/spwd');
Route::get('/home/respwd','/Home/respwd');
Route::get('/home/httphost','/Home/httphost'); //domain host 路由
Route::get('/home/token','/Home/token');  //登录验证路由
//Route::get('home/index:h','Home/index');
Route::get('u/:u','Url/index'); //二级模糊
~~~
-------------------------------
~~~
api docs (apiw文档)
https://docs.apipost.cn/preview/169c041b0119aa29/7d62d891a511cdb3
基本信息
接口状态： 开发中
接口URL： http://192.168.133.131/links/?url=https://www.bilibili.com/video/BV1V7411x7Qm?p%3D15%26spm_id_from%3DpageDriver&link=66666&pass=password
请求方式： POST
Content-Type： multipart/form-data
请求参数
Query参数及说明
参数名	示例值	参数类型	是否必填	参数描述
url	https://www.bilibili.com/video/BV1V7411x7Qm?p=15&spm_id_from=pageDriver	String	是
longurl
link	66666	String	否
shorturl
pass	password	String	否
password
响应示例
成功响应示例
{
"code": 200,
"msg": "success",
"data": {
"pass": "password",
"last_visit": "2021-08-10 17:40:38",
"url": "https://www.bilibili.com/video/BV1V7411x7Qm?p=15",
"link": "66666"
}
}
失败响应示例
{
"code": 400,
"msg": "link已存在",
"data": []
}

https://docs.apipost.cn/preview/4ff0289532b384fe/ff85ccdac21798a2
基本信息
接口状态： 开发中
接口URL： http://192.168.133.131/u/66666
请求方式： GET
Content-Type： multipart/form-data
响应示例
成功响应示例
https://www.bilibili.com/video/BV1V7411x7Qm?p=15

后台
/admin/start/#/user/login/redirect=%2F
or 
http://192.168.133.131/home
or
http://$hostname/home
默认用户密码
admin
123456
~~~
~~~

}
}

在服务器运行时请删除 .env 文件
当然可以先在 。env 文件开启  APP_DEBUG = true 调试，当网站正常运行在删除。env
然后配置下面的数据库文件
APP_DEBUG = true


数据库修改文件file
config/database.php
因为要写入session,所以给予runtime目录755权限
chmod -R 755 runtime
chown -R www.www runtime/
创建库
将short.sql 导入库中
short_com(2).sql是我在本地测试的十万条数据链接，经测试十万条数据依然稳定快捷，速度很快

~~~

~~~
待开发 
访问密码验证跳转功能  √
dan单条链接重复生成短链   √
url前台页面   √
api说明,前台显示  √
页面自动安装配置页面 
api文件/get 方式的缩短链接  √
link 链接的访问次数统计 √
首页api使用的方法等介绍 √
网站的首页导航的关键词等设置  后端√
对前台信息查询进行安全加固，如/links

//q前台页面的url请求
POST | get
http://192.168.133.131/home/api?type=toShort&kind=local&url=https%3A%2F%2Ftinyurl.com%2Fapi-create.php

api 请求 GET
http://192.168.133.131/Api/?url=http://192.168.133.131:8888/site
---17点46分




~~~

~~~
location ^~(api.php) {
	if (!-e $request_filename){
	    rewrite ^(api.php)(.*?)$ /Api.php?k=$2 last;
	  break;
	}}
location /home {
	if (!-e $request_filename){
	    rewrite ^(.*)(.*?)$ /$1?k=$2 last;
	  break;
	}}
location /links {
	if (!-e $request_filename){
    rewrite ^(.*)(.*?)$ /$1?k=$2 last;
    break;
	}}
location / {
	if (!-e $request_filename){
	  rewrite ^(/u/)?$ /u/$2?u=$1 last;
	  rewrite ^(.*)?$ /$2?s=$1 last;
	}
}

https://www.layui.com/doc/element/form.html
g官方文档



~~~