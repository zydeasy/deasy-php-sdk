# deasy SDK
## install
```js
composer require deasy/deasy-sdk
```
### socket
* 获取前端鉴权token
```js
use Deasy\Socket;
$socket = new Socket(appkey, secret);
$token = $socket.getToken();
```

* 服务器端推送信息
```js
use Deasy\Socket;
$socket = new Socket(appkey, secret);
$token = $socket.push([
  xxxxxxx
]);
```

### sms
* 发送短信
```js
use Deasy\Sms;
$sms = new Sms(appkey, secret);
$result = $sms.send(phone, msg, signname);
```