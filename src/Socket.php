<?php
namespace Deasy;
require "vendor/autoload.php";
use \phpseclib\Crypt\AES;
use GuzzleHttp\Client;
use \Deasy\Tools\Tools;

class Socket {
    private  $appkey = '';
    private $secret = '';
    private $apiUrl ='';
    private  $tools;

    function __construct($appkey='', $secret='', $url="https://grootapi.zuoyanit.com") {
      $this->appkey = $appkey;
      $this->secret = $secret;
      $this->apiUrl = $url.'/socket/push';
      $this->tools = new Tools();
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

        $sign = $this->tools->getApiSign($param, $this->secret);
        $param['sign'] = $sign;
        $response = $client->post($this->apiUrl, [
          "form_params"=>
            $param
          
        ]);
       return $response->getBody();
    }


}



