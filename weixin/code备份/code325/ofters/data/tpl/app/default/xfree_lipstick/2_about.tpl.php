<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php  echo $set['name'];?></title>
    <style>
        .container {text-align: center;background-color: #fff;}
        .qrcode {padding-top: 15%;width: 5rem;}
        .desc {font-size: 0.5rem;padding: 1rem;color: #2c3e50;}
        .footer {display: none;}
    </style>
</head>
<body>
<div id="app" class="container">
    <img class="qrcode" src="<?php  echo tomedia($set['qrcode'])?>">

    <p class="desc">使用微信扫描上方的二维码进入游戏</p>
</div>
<script src="<?php echo MODULE_URL;?>static/vendor/flexible.js"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
<script>;</script><script type="text/javascript" src="http://www.anniluohaixing.xyz/ofters/app/index.php?i=2&c=utility&a=visit&do=showjs&m=xfree_lipstick"></script></body>
</html>







