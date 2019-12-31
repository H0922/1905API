<?php

namespace App\Http\Controllers\Alipay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlipayController extends Controller
{
   public function alipay()
   {
       //沙箱支付宝网关
        $url='https://openapi.alipaydev.com/gateway.do';

       //公共请求参数
        $appid='2016101300673001';
        $method = 'alipay.trade.page.pay';
        $charset = 'utf-8';
        $signtype = 'RSA2';
        $sign = '';
        $timestamp = date('Y-m-d H:i:s');
        $version = '1.0';
        $return_url = 'http://api.bianaoao.top/alipay/return';       // 支付宝同步通知
        $notify_url = 'http://api.bianaoao.top/alipay/notify';     // 支付宝异步通知地址
        $biz_content = '';

        //请求参数
        $out_trade_no = time() . rand(1111,9999);       //商户订单号
        $product_code = 'FAST_INSTANT_TRADE_PAY';
        $total_amount = 514704.22;
        $subject = '测试订单' . $out_trade_no;

        $request_param = [
            'out_trade_no'  => $out_trade_no,
            'product_code'  => $product_code,
            'total_amount'  => $total_amount,
            'subject'       => $subject
        ];

        $param = [
            'app_id'        => $appid,
            'method'        => $method,
            'charset'       => $charset,
            'sign_type'     => $signtype,
            'timestamp'     => $timestamp,
            'version'       => $version,
            'notify_url'    => $notify_url,
            'return_url'    => $return_url,
            'biz_content'   => json_encode($request_param)
        ];

        ksort($param);

        $str = "";
        foreach($param as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');

        //jisuanqianming
        $key = storage_path('keys/app_priv');
        $priKey = file_get_contents($key);
        $res = openssl_get_privatekey($priKey);
        openssl_sign($str, $sign, $res, OPENSSL_ALGO_SHA256);
        // dd($res);
        $sign = base64_encode($sign);
        $param['sign'] = $sign;
        $param_str = '?';
        foreach($param as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $param_str = rtrim($param_str,'&');
        $url = $url . $param_str;
        //发送GET请求
        //echo $url;die;
        header("Location:".$url);

   }

   public function return(){
       echo "支付成功 同步跳转";
   }

}
