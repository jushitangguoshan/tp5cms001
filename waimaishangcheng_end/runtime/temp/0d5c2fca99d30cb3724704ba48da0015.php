<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\takeout.com\public/../application/admin\view\socket\index.html";i:1554715329;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>aaaa</h1>
<script src='http://cdn.bootcss.com/socket.io/1.3.7/socket.io.js'></script>
<script>
    // 连接服务端，workerman.net:2120换成实际部署web-msg-sender服务的域名或者ip
    var socket = io('http://www.takeout.com:2120');
    // uid可以是自己网站的用户id，以便针对uid推送以及统计在线人数
    uid = 123;
    // socket连接后以uid登录
    socket.on('connect', function(){
        socket.emit('login', uid);
    });
    // 后端推送来消息时
    socket.on('new_msg', function(msg){
        console.log(msg);
    });
</script>
</body>
</html>