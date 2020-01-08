<?php

namespace App\Http\Controllers\Keys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\PublicModel as Pub;
class PubController extends Controller
{
    //添加公钥页面
    public function addpub(){
        //$id=Auth::id();
        //$pubkey=Pub::where('user_id','=',$id)->value('pub_key');
        // if($pubkey){
        //     return view('keys.lists',['pubkey'=>$pubkey]);
        // }else{
            return view('keys.create'); 
         //   }
    
    }
    //解密展示
    public function lists(){
        return view('keys.lists');
    }


    //执行
    public function create(){
          // 获取用户id
          $id=Auth::id();
          $pub=request()->input('pub');
          $name=Auth::user()->name;
        $data=[
            'user_id'=>$id,
            'pub_key'=>trim($pub),
            'pub_name'=>$name
        ];
        Pub::where('user_id','=',$id)->delete();
        $res=Pub::insert($data);
        if($res){
            echo '添加成功   您的公钥为：';
            echo '<br>';
            echo $pub;
            echo '<br>';
            echo '正在为您跳转............';
            header('Refresh: 3; url=' . env('APP_URL') . '/home');
            
        }
    }

    public function keyss(){
      $base=request()->input('pub');
      $id=Auth::id();
      $pubkey=Pub::where('user_id','=',$id)->value('pub_key');
      $bsae=base64_decode($base);
      openssl_public_decrypt($bsae,$data,$pubkey);  
      echo '解密后的数据：'. $data;
    }

    public function sign(){
      return view('keys.sgin');
    }
    
    public function signcre(){
        $data=$_POST;
        $sign=$data['sign'];
        $sign=base64_decode($sign);
        dump($sign);
        unset($data['sign']);
        unset($data['_token']);
        // ksort($data);
        $params = [];
        foreach ($_POST['k'] as $k=>$v)
        {
            if(empty($v)){
                continue;       //跳过空字段
            }
            $params[$v] = $_POST['v'][$k];
        }
       ksort($params);
       dump($params);
       $str="";
       foreach($params as $k=>$v){
            $str.=$k.'='.$v.'&';
       }
       $str=rtrim($str,'&');
       echo $str;
       echo '<hr>';
       $id=Auth::id();
       $pubkey=Pub::where('user_id','=',$id)->value('pub_key');
       $r=openssl_verify($str,$sign,$pubkey,OPENSSL_ALGO_SHA256);
       if($r){
            echo '验签成功,您的签名可以正常使用';
       }else{
            echo '验签失败';
       }
    }
}
