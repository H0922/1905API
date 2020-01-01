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
Route::get('alipay/notify','Alipay\AlipayController@notify');



