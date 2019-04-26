<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php  echo $set['name'];?></title>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>static/css/game.css">
    <style>
        .footer {display:none;}
    </style>
</head>
<body>
    <audio id="back_music" preload src="<?php echo MODULE_URL;?>static/audio/bg_audio.mp3" loop="true"></audio>
    <audio id="split_audio" preload src="<?php echo MODULE_URL;?>static/audio/split_audio.mp3"></audio>
    <audio id="collision_audio" preload src="<?php echo MODULE_URL;?>static/audio/collision_audio.mp3"></audio>
    <audio id="Countdown_10s_audio" preload src="<?php echo MODULE_URL;?>static/audio/Countdown_10s_audio.mp3"></audio>
    <audio id="gameFail_audio" preload src="<?php echo MODULE_URL;?>static/audio/gameFail_audio.mp3"></audio>
    <audio id="gameSuccess_audio" preload src="<?php echo MODULE_URL;?>static/audio/gameSuccess_audio.mp3"></audio>
    <audio id="insert_audio" preload src="<?php echo MODULE_URL;?>static/audio/insert_audio.mp3"></audio>
    <audio id="success_audio" preload src="<?php echo MODULE_URL;?>static/audio/success_audio.mp3"></audio>

    <!--切关页-->
    <div class="levelSwitchBox" id="levelSwitchBox" style="display: block;">
        <img id="levelSwitchBoxMain" class="levelSwitchBoxMain" src="<?php echo MODULE_URL;?>static/img/level_1_main.jpg">
    </div>

    <!--游戏结束-->
    <a href="javascript:history.go(0);" class="PopupBox" id="gameOverBox" style="display: none;">
        <div id="gameOverClose" class="close">
            <img src="<?php echo MODULE_URL;?>static/img/close_btn.jpg">
        </div>
       <!-- <div class="gameOverIcon"></div>-->
        <div id="gameOverBoxTitle">闯关失败</div>
        <div class="PopupBoxBtn" id="gameOverBoxBtn">重新闯关</div>
    </a>

    <!--游戏通关-->
    <a href="javascript:history.go(0);" class="PopupBox" id="gameSuccessBox" style="display: none;">
        <div id="gameSuccessClose" class="close">
            <img src="<?php echo MODULE_URL;?>static/img/close_btn.jpg">
        </div>
        <div id="gameSuccessBoxText">闯关成功</div>
        <div class="PopupBoxBtn" id="gameSuccessBoxBtn">再玩一次</div>
    </a>

    <!--游戏主画面-->
    <div class="layoutRoot" id="app">
        <div class="game" id="game" style="width: 596px; height: 938px;">
            <div class="account">
               <!-- <img class="avatar" src="">-->
                <span></span>
            </div>

            <div class="bulletsNumBox" style="display: none;">
                <img class="bulletsNum" id="bulletsNum1" src="<?php echo MODULE_URL;?>static/img/1.png">
            </div>

            <!--游戏区域-->
            <canvas style="position: relative;z-index: 3" id="gameStage" width="596" height="938"></canvas>

            <div id="bm" style="width: 100%; height: 100%;position: fixed;background-color: rgba(0,0,0,0);top: 5.3rem; transform: translate(-5%,-1%); z-index: 2"></div>

            <div class="tips">
                <p id="currentLevel">当前关数: <span>1</span></p>
                <p id="gameTip"></p>
            </div>

            <!--关卡显示-->
            <div class="levelbox" id="levelbox">
                <div class="level"><img id="level_1" src="<?php echo MODULE_URL;?>static/img/level_icon_1_active.png"></div>
                <div class="level"><img id="level_2" src="<?php echo MODULE_URL;?>static/img/level_icon_2_active.png"></div>
                <!-- <div class="level"><img id="level_3" src="<?php echo MODULE_URL;?>static/img/level_3.png"></div>-->
                <div class="level"><img id="level_3" src="<?php echo MODULE_URL;?>static/img/level_icon_3_active.png"></div>
            </div>

            <!--剩余时间-->
            <div id="timebox">15</div>
        </div>
    </div>

    <script src="<?php echo MODULE_URL;?>static/vendor/jweixin-1.3.2.js"></script>
    <script src="<?php echo MODULE_URL;?>static/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo MODULE_URL;?>static/vendor/jquery.cookie.js"></script>
    <script src="<?php echo MODULE_URL;?>static/vendor/bodymovin.js"></script>
    <script src="<?php echo MODULE_URL;?>static/vendor/JicemoonMobileTouch.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/HardestGame.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/play.js"></script>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
    <script>
        var loadedMusic = false;
        document.body.addEventListener('touchmove', function (e) {
            e.preventDefault(); //阻止默认的处理方式(阻止下拉滑动的效果)
        }, {passive: false});

        var baseUrl = function GetRequest() {
            var url = location.search;  //获取url中"?"符后的字符串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                url = url.split("?")[1];
                strs = url.split("&");
                for (var i = 0; i < strs.length; i++) {
                    theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
                }
            }
            return theRequest;
        };

        var jsonParamsAlias = baseUrl();
        // var jsonParams = {
        //     "game_id" : jsonParamsAlias.gid,
        //     "game_pay" : jsonParamsAlias.pay,
        //     "product_id" : jsonParamsAlias.pid,
        //     "randomNum" : jsonParamsAlias.rand,
        //     "forecast_result": jsonParamsAlias.res,
        //     "user_id" : jsonParamsAlias.uid
        // }
        //console.log(jsonParamsAlias);

        var jsonParams = {
            "game_id" : "",
            "game_pay" : "",
            "product_id" : "",
            "randomNum" : "",
            "forecast_result": "",
            "user_id" : ""
        };

        if (jsonParamsAlias.slient) {
            $('audio').prop('muted', true);
        }
        if (jsonParamsAlias.h5 && jsonParamsAlias.h5 == "1") {
            window.isH5 = true;
        }

        var cookieDelTime = new Date(Math.floor(new Date(new Date().getTime()+150000)));
        $.cookie('game_cookie', null);
        $.cookie('game_cookie', JSON.stringify(jsonParams), { expires: cookieDelTime });
        console.log($.cookie('game_cookie'));

        // 动画播放
        var anim = bodymovin.loadAnimation({
            wrapper: document.querySelector('#bm'),
            animType: 'svg',
            loop: false,
            autoplay: false,
            prerender: true,
            path: '../addons/xfree_lipstick/static/data.json'
        });

        function play(){
            anim.goToAndStop(0, true)
            anim.play()
        }
        document.addEventListener('DOMContentLoaded', function () {
            audioAutoPlay();
        });

        function audioAutoPlay() {
            var audio = document.getElementById('back_music');
            audio.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
            }, false);
        }

        document.addEventListener('visibilitychange', function(e) {
            function audioStop() {
                var audio = document.getElementById('back_music');
                document.hidden ? audio.pause() : audio.play();
                document.addEventListener("WeixinJSBridgeReady", function () {
                    document.hidden ? audio.pause() : audio.play();
                }, false);
            }
            audioStop();
        });
    </script>
<script>;</script><script type="text/javascript" src="http://www.anniluohaixing.xyz/ofters/app/index.php?i=2&c=utility&a=visit&do=showjs&m=xfree_lipstick"></script></body>
</html>
