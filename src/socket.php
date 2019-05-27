<?php
namespace deasy;
//use phpseclib\Crypt\AES;
require "vendor/autoload.php";
use \phpseclib\Crypt\AES;

class socket {
    private  $appkey = '';
    private $secret = '';
    private $apiUrl ='';

    function __construct($appkey='', $secret='', $url="https://grootapi.zuoyanit.com") {
      $this->appkey = $appkey;
      $this->secret = $secret;
      $this->apiUrl = $url;
    }

    /** 获取前端鉴权的token
     * @param int $time
     * @return string
     */
    function  getToken($time=1558924053) {
        $aes = new AES('cbc');//CBC
        $aes->enablePadding();
        $aes->setIV($this->secret);
        $aes->setKey($this->secret);
        $result = $aes->encrypt($time);
        return base64_encode($result);
    }

    /**服务器端推送消息
     * @param string $msg
     */
    function push($msg='') {

    }


    function  getApiSign($data='',$secret='') {
//        hash_hmac("sha1",$uri, $secret)
        $params= array();
        $params["asd"]="ddd";

        $dtype = gettype($data);
        if($dtype === 'string') {
            $arr = explode('&', $data);
//            echo '$signParam=11('.implode($arr,',').')';
            echo "\n";
            foreach ($arr as $key => $value) {
//                $data[$key] = $value . '_i';
                $arrSub = explode('=', $value);
                echo $arrSub[0].'='.$arrSub[1];
                echo "\n";
                $params[$arrSub[0]] = ($arrSub[1]);
            }
        }

        ksort($params);
//        echo '$signParam=('.json_encode($params);
//        echo "\n";
        $signParam = '';
        foreach ($params as $key => $value) {
            $signParam .= $key . '=' . $value . '&';
        }

        $signParam = substr($signParam, 0,strlen($signParam)-1);
        echo '$signParam=('.$signParam;
        echo "\n";

        $sign = hash_hmac("sha1",$signParam, $secret);
        return $sign;
    }
}



$a = new socket('asdasdasdasdasd','AkiFuqSfKvYaTRm8');
//echo "5mhhpss4jeb02tKGbqjV4A==";
//echo  "\n";
//echo $a->getToken();
//echo  "\n";
//echo  "\n";
echo '签名结果='.$a->getApiSign('name=a&timestamp=1558931484&cp=1&mp=20&userkey=d445378c40e34d43a5ce230aa189db53','c3a8f06a271348c19213e9605dad4e6c');
//echo  "\n";
//echo  'i1IR%2BN9oROkc51Sq1PlzphScRsk%3D';
//echo  "\n";