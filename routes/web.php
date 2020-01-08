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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function () {
    phpinfo();
});
//支付
Route::get('alipay/pay','Alipay\AlipayController@alipay');
//同步
Route::get('alipay/return','Alipay\AlipayController@return');
//异步
Route::post('alipay/notify','Alipay\AlipayController@notify');
//注册
Route::post('alipay/create','Alipay\AlipayController@create');
//登录
Route::post('alipay/login','Alipay\AlipayController@login');
//访问记录
Route::get('alipay/userlist','Alipay\AlipayController@userlist')->middleware('UserList');

Route::get('jia','Alipay\AlipayController@jia');

Route::get('keys/create','Keys\PubController@addpub');
Route::post('keys/insert','Keys\PubController@create');
Route::post('keys/keyss','Keys\PubController@keyss');
Route::get('keys/lists','Keys\PubController@lists');
Route::get('keys/sign','Keys\PubController@sign');
Route::post('keys/signcre','Keys\PubController@signcre');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
