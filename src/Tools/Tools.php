<?php
namespace Deasy\Tools;

use \phpseclib\Crypt\AES;

class Tools {
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
        $signParam = urlencode(substr($signParam, 0,strlen($signParam)-1));
        $sign = urlencode(base64_encode(hash_hmac("sha1",$signParam, $secret,true)));
        return $sign;
    }
}