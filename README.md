# deasy SDK
### socket
* 获取前端鉴权token
```js
use deasy\Socket;
$socket = new Socket(appkey, secret);
$token = $socket.getToken();
```

* 服务器端推送信息
```js
use deasy\Socket;
$socket = new Socket(appkey, secret);
$token = $socket.push([
  xxxxxxx
]);
```