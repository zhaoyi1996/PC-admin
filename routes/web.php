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