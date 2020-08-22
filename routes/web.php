<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::any('/', function () {
    return view('welcome');
});
//发送验证码
Route::any('/vicode','api\LoginController@vicode');

Route::any('/login','api\LoginController@login');

Route::any('/test','api\LoginController@test');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::any('/' , 'IndexController@index' );

//友情链接
Route::get('/links/create',"LinkController@create");
Route::get('/links/index',"LinkController@index");
Route::post('/links/add',"LinkController@add");
Route::get('/links/del/{id}',"LinkController@del");
Route::get('/links/edit/{id}',"LinkController@edit");
Route::post('/links/update/{id}',"LinkController@update");
# 角色添加
Route::any('/role/add' , 'RoleController@roleAdd' );

# 角色列表
Route::any('/role/list' , 'RoleController@roleList' );

# 权限节点添加
Route::any('/powerNode/add' , 'PowerNodeController@powerNodeAdd' );

# 权限列表
Route::any('/powerNode/list' , 'PowerNodeController@powerNodeList' );

# 管理员添加
Route::any('/admin/add' , 'AdminController@adminAdd' );

# 管理员列表
Route::any('/admin/list' , 'AdminController@adminList' );
