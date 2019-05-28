<?php
namespace Deasy;
require "vendor/autoload.php";
use \phpseclib\Crypt\AES;
use GuzzleHttp\Client;

class Socket {
    private  $appkey = '';
    private $secret = '';
    private $apiUrl ='';

    function __construct($appkey='', $secret='', $url="https://grootapi.zuoyanit.com") {
      $this->appkey = $appkey;
      $this->secret = $secret;
      $this->apiUrl = $url.'/socket/push';
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
        $client = new \GuzzleHttp\Client();
        $param = [];
        $param['timestamp'] = time();
        $param['appkey'] = $this->appkey;
        if(gettype($msg)==='string'){
        $param['msg'] = $msg;//json_encode($msg,true);
        } else {
            $param['msg'] = json_encode($msg,true);
        }
        // $t = 'timestamp='.time().'&appkey='.$this->appkey.'&msg='.$msg;
        $sign = $this->getApiSign($param, $this->secret);
        $param['sign'] = $sign;
        $t.='&sign='.$sign;
        echo "$sign=".$sign;
        $response = $client->post($this->apiUrl, [
          "form_params"=>
            $param
          
        ]);
       return $response->getBody();
    }

    /**
     * 获取签名
     */
    function  getApiSign($data='',$secret='') {
        $params= array();
        $dtype = gettype($data);
        if($dtype === 'string') {
            $arr = explode('&', $data);
            foreach ($arr as $key => $value) {
                $arrSub = explode('=', $value);
                $params[$arrSub[0]] = urlencode($arrSub[1]);
            }
        } else {
            $params = $data;
        }
        ksort($params);
        $signParam = '';
        foreach ($params as $key => $value) {
            $signParam .= $key . '=' . $value . '&';
        }
        echo "asdasd+".$signParam;
        echo "\n";
        $signParam = urlencode(substr($signParam, 0,strlen($signParam)-1));
        $sign = urlencode(base64_encode(hash_hmac("sha1",$signParam, $secret,true)));
        return $sign;
    }
}



