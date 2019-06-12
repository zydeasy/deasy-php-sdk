<?php
namespace Deasy;
require "vendor/autoload.php";
use GuzzleHttp\Client;
use \Deasy\Tools\Tools;

class Sms {
    private  $appkey = '';
    private $secret = '';
    private $apiUrl ='';
    private  $tools;

    function __construct($appkey='', $secret='', $url="https://grootapi.zuoyanit.com") {
      $this->appkey = $appkey;
      $this->secret = $secret;
      $this->apiUrl = $url.'/api/sms/send';
      $this->tools = new Tools();
    }

    /**服务器端推送消息
     * @param string $msg
     */
    function send($phone, $msg='', $signname='') {
        $client = new \GuzzleHttp\Client();
        $param = [];
        $param['timestamp'] = time();
        $param['appkey'] = $this->appkey;
        $param['msg'] = $msg;
        $param['phone'] = $phone;
        $param['signname'] = $signname;


        $sign = $this->tools->getApiSign($param, $this->secret);
        $param['sign'] = $sign;
        $response = $client->post($this->apiUrl, [
          "form_params"=>
            $param
          
        ]);
       return $response->getBody();
    }


}



