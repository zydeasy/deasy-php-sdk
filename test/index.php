<?php

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}
if (is_file('/../vendor/autoload.php')) {
    require_once '/vendor/autoload.php';
}

// use Deasy\Socket;
use Deasy\Sms;

// $a = new Socket('5cdad8fab007211b603c705c','abcdefgabcdefg12','http://192.168.3.161:8464');
$sms = new Sms('e288dcd940b4561a58ea378f9dc0b684','a9b86566de7f4df5a6c46fd91957203b','http://127.0.0.1:8464');
$aa = $sms->send('15537172119','tessssssssss','deasy');
echo $aa;
 //echo "5mhhpss4jeb02tKGbqjV4A==";
 //echo  "\n";
 //echo $a->getToken();
 //echo  "\n";
 //echo  "\n";
 // $p = [];
 // $p['name']='';
 // $p['timestamp']=1558931484;
 // $p['cp']=1;
 // $p['mp']=20;
 // $p['userkey']='d445378c40e34d43a5ce230aa189db53';

 // echo 'i1IR%2BN9oROkc51Sq1PlzphScRsk%3D  =  '.$a->getApiSign('name=&timestamp=1558931484&cp=1&mp=20&userkey=d445378c40e34d43a5ce230aa189db53','c3a8f06a271348c19213e9605dad4e6c');
 echo "\n";
 echo "\n";
 // echo 'i1IR%2BN9oROkc51Sq1PlzphScRsk%3D  =  '.$a->getApiSign($p,'c3a8f06a271348c19213e9605dad4e6c');
 //echo  "\n";
 //echo  'i1IR%2BN9oROkc51Sq1PlzphScRsk%3D';
 //echo  "\n";
//  echo $a->push([
//    'user'=>'1',
//    'group'=>"test",
//    'event'=>"aa",
//    'msg'=>[
//      "a"=>"d"
//    ]
//  ]);