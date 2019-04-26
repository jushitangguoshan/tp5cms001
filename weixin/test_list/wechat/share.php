<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22 0022
 * Time: 上午 11:24
 */

require_once "JSSDK.php";
$jssdk = new JSSDK();
$signPackage = $jssdk->getSignPackage();
$news = array(
    "Title"      =>"勇士，你来了，这边来",
    "Description"=>"即将开始你的峡谷之旅吧，不要怂，上",
    "PicUrl"     =>'https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1553221774&di=4decede8964b2227e56f4eb57a96f383&src=http://b-ssl.duitang.com/uploads/item/201712/05/20171205202646_wZ8KJ.jpeg',
    "Url"        =>'http://www.anniluohaixing.xyz');


/*
 * <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>添加标记</title>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77"></script>
    <style type="text/css">
        *{
            margin:0px;
            padding:0px;
        }
        body, button, input, select, textarea {
            font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
        }
        #info{
            width:603px;
            padding-top:3px;
            overflow:hidden;
        }
        .btn{
            width:112px;
        }
        #container{
            min-width:600px;
            min-height:767px;
        }
    </style>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
            wx.config({
                debug: false,
                appId: '<?=$signPackage["appId"];?>',
                timestamp: <?=$signPackage["timestamp"];?>,
                nonceStr: '<?=$signPackage["nonceStr"];?>',
                signature: '<?=$signPackage["signature"];?>',
                jsApiList: [
                    // 所有要调用的 API 都要加到这个列表中
                    'checkJsApi',
                    'openLocation',
                    'getLocation',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage'
                ]
            });
            wx.ready(function () {
                wx.checkJsApi({
                    jsApiList: [
                        'getLocation',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage'
                    ],
                    success: function (res) {
                        console.log(res);
                    },
                });

                wx.getLocation({
                    success: function (res) {
                        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                        var speed = res.speed; // 速度，以米/每秒计
                        var accuracy = res.accuracy; // 位置精度
                        //console.log(latitude,longitude);
                            var center = new qq.maps.LatLng(latitude,longitude);
                            var map = new qq.maps.Map(document.getElementById('container'),{
                                center: center,
                                zoom: 13
                            });
                            var marker = new qq.maps.Marker({
                                position: center,
                                map: map
                            });
                            qq.maps.event.addListener(marker,"click",function(){
                                alert("you clicked me")
                            });
                            //setMap
                            var mapM=document.getElementById("mapM");
                            qq.maps.event.addDomListener(mapM,"click",function(){
                                marker.setVisible(true);
                                if(marker.getMap()){
                                    marker.setMap(null);
                                }else{
                                    marker.setMap(map);
                                }
                            });
                            //setClickable
                            var cable=document.getElementById("cable");
                            qq.maps.event.addDomListener(cable,"click",function(){
                                marker.setVisible(true);
                                if(marker.getClickable()){
                                    marker.setClickable(false);
                                }else{
                                    marker.setClickable(true);
                                }
                            });
                            //setDraggable
                            var drag=document.getElementById("drag");
                            qq.maps.event.addDomListener(drag,"click",function(){
                                marker.setVisible(true);
                                if(marker.getDraggable()){
                                    marker.setDraggable(false);
                                }else{
                                    marker.setDraggable(true);
                                }
                            });
                            //setVisible
                            var visibleF=document.getElementById("visibleF");
                            qq.maps.event.addDomListener(visibleF,"click",function(){
                                marker.setMap(map);
                                if(marker.getVisible()){
                                    marker.setVisible(false);
                                }else{
                                    marker.setVisible(true);
                                }
                            });
                            //setPosition
                            var flag=true;
                            var setP=document.getElementById("setP");
                            var latLng=new qq.maps.LatLng(39.908709,116.397519);
                            //添加Dom监听事件
                            qq.maps.event.addDomListener(setP,"click",function(){
                                marker.setMap(map);
                                if(flag){
                                    flag=false;
                                    marker.setPosition(latLng);
                                }else{
                                    flag=true;
                                    marker.setPosition(center);
                                }
                            });
                             //returnIndex(latitude,longitude);
                    },
                    cancel: function (res) {
                        alert('用户拒绝授权获取地理位置');
                    }
                });

            });
        </script>
<body>
<div id="container"></div>
<div id="info" style="margin-top:10px;">
    <button id="mapM" class="btn">setMap</button>
    <button id="cable" class="btn">setClickable</button>
    <button id="drag" class="btn">setDraggable</button>
    <button id="visibleF" class="btn">setVisible</button>
    <button id="setP" class="btn">setPosition</button>
</div>
</body>
</html>
*/
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no width=device-width">
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css" />
    <title>位置</title>
    <style>
        html, body, #container {
            width: 100%;
            height: 100%;
        }
        .amap-icon img{
            width: 25px;
            height: 34px;
        }
    </style>
</head>
<body>
<div id="container"></div>
</body>
</html>
<!-- 加载地图JSAPI脚本 -->
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.13&key=a8763cdc51a945cd98cf36e8ac156b6b"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: false,
        appId: '<?=$signPackage["appId"];?>',
        timestamp: <?=$signPackage["timestamp"];?>,
        nonceStr: '<?=$signPackage["nonceStr"];?>',
        signature: '<?=$signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'checkJsApi',
            'openLocation',
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        wx.checkJsApi({
            jsApiList: [
                'getLocation',
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ],
            success: function (res) {
                //alert(JSON.stringify(res));
            },
        });
        wx.onMenuShareAppMessage({
            title: '<?php echo $news['Title'];?>',
            desc: '<?php echo $news['Description'];?>',
            link: '<?php echo $news['Url'];?>',
            imgUrl: '<?php echo $news['PicUrl'];?>',
            trigger: function (res) {
                // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                // alert('用户点击发送给朋友');
            },
            success: function (res) {
                // alert('已分享');
            },
            cancel: function (res) {
                // alert('已取消');
            },
            fail: function (res) {
                // alert(JSON.stringify(res));
            }
        });

        wx.onMenuShareTimeline({
            title: '<?php echo $news['Title'];?>',
            link: '<?php echo $news['Url'];?>',
            imgUrl: '<?php echo $news['PicUrl'];?>',
            trigger: function (res) {
                // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                 //alert('用户点击分享到朋友圈');
            },
            success: function (res) {
                 alert('已分享');
            },
            cancel: function (res) {
                 //alert('已取消');
            },
            fail: function (res) {
                 //alert(JSON.stringify(res));
            }
        });
        wx.getLocation({
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                // console.log(latitude); console.log(longitude);
                returnIndex(latitude,longitude);
            },
            cancel: function (res) {
                alert('用户拒绝授权获取地理位置');
            }
        });
    });
    //转换高德坐标
    function returnIndex(latitude,longitude){
        var gps = [latitude, longitude];
        AMap.convertFrom(gps, 'gps', function (status, result) {
            // console.log(status,result);
            if (result.info === 'ok') {
                var data = result.locations; // Array.<LngLat>
                //console.log(data);
                gps =[data[0].lat,data[0].lng];
            }
        });
        var map  = new AMap.Map('container', {
            resizeEnable: true,
            center: [gps[1], gps[0]] ,//初始化地图中心点,
            zoom: 16, //初始地图级别
        });
    }
</script>



