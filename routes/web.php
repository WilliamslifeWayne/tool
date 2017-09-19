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
// 根目录
Route::get('/', 'Admin\LoginController@index');

Route::group(['prefix' => 'admin'], function(){
    //登录
    Route::get('/login', 'Admin\LoginController@login');
    Route::post('/login', 'Admin\LoginController@logincheck');
    Route::get('/logout', 'Admin\LoginController@logout');
    //获取验证码
	Route::get("/login/getCheckCode", "Admin\LoginController@getCheckCode");
    Route::group(['middleware' => 'login'], function(){
        //首页
        Route::get('/index', 'Admin\IndexController@index');
        
    });
});