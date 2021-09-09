<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
//Route::get('favicon.ico','favicon.ico');
Route::rule('/home/api','/Home/api','GET|POST');
Route::get('/home/captcha','/Home/verify'); //http://192.168.133.131/home/captcha?1627879768528=  此目录接参数,不用加  :h
Route::get('/home/index','/Home/index');  //家入口路由

Route::post('links/edit','Links/edit');
Route::post('links/del','Links/del');
Route::post('links/addlink','Links/addlink');
Route::delete('links/delete','Links/delete');
Route::get('links/read','Links/read');
Route::post('links/dels','Links/dels');
Route::get('links/index','Links/index');

Route::get('/home/setuser','Home/setuser'); // 用户管理路由
Route::get('/home/save','/Home/save');
Route::get('/home/spwd','/Home/spwd');
Route::get('/home/respwd','/Home/respwd');
Route::get('/home/httphost','/Home/httphost'); //domain host 路由
Route::get('/home/token','/Home/token');  //登录验证路由
Route::get('u/:u','Url/index');
//Route::get('/index','/Index/index');


/*  路由也有顺序, :s 模糊匹配的放最后, 'u/:k' 二级模糊匹配,方倒数第二. 'home' 三级精准匹配最上面精准匹配 */
/*  -http://192.168.133.131/u/dfg45 nginx 规则 在源URL中 /u/为$1,那么第二个(.*)$ 后面的无限匹配为第二个参数
在301 重定向时, 地址为 /u/$2 即可 后面的 ?k=$1 是传的参数,因/u/目录不变,所以$1 用来传参,
在路由接收这里,u/:k为匹配到的地址加传参, 后面的Url/index 为路由跳转的类和具体的方法(页面).---
这里是传参在路由跳转这里不用写'Url/index:k',bur不然会成为 方法不存在:app\controller\Url->indexdfg45(),路由回去找这个类Url里面的方法indexdfg45(),也就是 /url/index/indexdfg45
如果不想开启 重 /u/二级目录跳转路径,将路由注释即可   Route::get('u/:k','Url/index');    */
/*Route::get(':s','index/index');获取在 http://192.168.133.131/1111 根URL ho后面的值传到对应的方法下,我的是Index/index 方法*/


/*
 * location / {
	if (!-e $request_filename){
    rewrite ^(/links/)(.*)(.*?)$ /links/$2?k=$3 last;
	  rewrite ^(/home/)(.*)(.*?)$ /home/$2?h=$3 last;
	  rewrite ^(/u/)(.*)$ /u/$2?k=$1 last;
	  rewrite ^(/u/)(.*?)$ /u/$2?u=$1 last;
	  rewrite ^(.*)(.*?)$ /$1?s=$2 last;
	}
}

u可以跳转
location / {
	if (!-e $request_filename){
    rewrite ^(/links/)(.*)(.*?)$ /links/$2?k=$3 last;
	  rewrite ^(/home/)(.*)(.*?)$ /home/$2?h=$3 last;
	  rewrite ^(/u/)?$ /u/$2?u=$1 last;
	  rewrite ^(.*)?$ /$2?s=$1 last;
	}
}


sj2021年8月10日16:59:57

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

------2021年8月10日18:04:27
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
--
https://docs.apipost.cn/preview/169c041b0119aa29/7d62d891a511cdb3

*/
















