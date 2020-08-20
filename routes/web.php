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

