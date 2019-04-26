<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:63:"E:\takeout.com\public/../application/front\view\home\index.html";i:1555058381;s:50:"E:\takeout.com\application\front\view\inc\nav.html";i:1554867595;s:53:"E:\takeout.com\application\front\view\inc\footer.html";i:1554715329;s:60:"E:\takeout.com\application\front\view\inc\shopping_cart.html";i:1554809547;s:52:"E:\takeout.com\application\front\view\inc\login.html";i:1555066792;s:55:"E:\takeout.com\application\front\view\inc\register.html";i:1555066792;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="“订饭组（dingfanzu.com）”是北京地区知名的在线外卖订餐O2O平台，是写字楼白领专属订餐网站。已覆盖北京数百个写字楼，数十万用户，聚集了数千家餐饮商户。订外卖，找订饭组。" />
    <script src="/static/front/js/jquery-1.8.3.js"></script>
    <script src="/static/front/js/jquery.reveal.js"></script>
    <script src="/static/front/js/jquery.cookie.js"></script>
    <link rel="icon" href="/static/front/image/favicon.ico">
    <link rel=stylesheet href="/static/front/css/reset.css">
    <link rel=stylesheet href="/static/front/css/common.css">
    <link rel=stylesheet href="/static/front/css/base.css">
    <link rel=stylesheet href="/static/front/css/header.css">
    <link rel=stylesheet href="/static/front/css/shopcart.css">
    <link rel=stylesheet href="/static/front/css/place.css">
    <link rel=stylesheet href="/static/front/css/footer_1.css">
    <link rel=stylesheet href="/static/front/css/reveal.css">
    <link rel=stylesheet href="/static/front/css/login.css">
    <title>订饭组-写字楼外卖_订餐组_订餐官网</title>
</head>
<body>
<!--header部分-->
<div class="header shadow">
    <div class="search-result">
    </div>
    <div class="header-left fl">
        <div class="icon fl"></div>
        <a class="weixin-dingfan fw" href="#">微信订饭</a>
        <a class="logo" href="<?php echo url('front/home/index'); ?>"></a>
        <div class="search">
            <img class="search-icon" src="/static/front/image/icon_search.png" width="20" height="20">
            <input id="search-input" class="search-input" type="text" placeholder="请输入楼名" onkeypress="onKeySearch()">
            <span id="search-del" class="search-del">&times;</span>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header-right fr">
        <div class="login fl">
                    <span class="header-operater">
                    <a href="#">外卖</a>
                    <a href="">我的订单</a>
                    <a href="<?php echo url('front/about/aboutme'); ?>">联系我们</a>
                    </span>
            <a id="header-login" class="navBtn f-radius f-select n" data-reveal-id="myModal" data-animation="fade"  style="display: inline;">
                登录
            </a>
        </div>
        <div id="cart" class="cart fr">
            <img class="cart-icon" src="/static/front/image/icon_cart_22_22.png">
        </div>
        <div id="user" class="user fr n">
            <img class="user-icon" src="/static/front/image/icon_my.png">
        </div>
    </div>
    <ul id="subnav" class="subnav subnav-shadow n">
        <li><a href="" target="">账号设置</a></li>
        <li><a href="" target="">我的订单</a></li>
        <li><a href="" target="">我的余额</a></li>
        <li><a href="" target="">我的积分</a></li>
        <li><a href="" target="">我的地址</a></li>
        <li><a id="sub-logout" href="#" target="">退出</a></li>
    </ul>
</div>
<script>
    //存在cookie刷新不变登录状态
    if($.cookie('userId')){
        //console.log($.cookie('userId'));
        $('#header-login').hide();
        $('#user').css('display','block');
    }
    $('#sub-logout').click(function () {
        //清除cookie
        $.removeCookie('userId',{ path: '/'});
        $.removeCookie('userId',{ path: '/front/home'});
        $('#header-login').show();
        $('#user').css('display','none');
    })
</script>
<!--内容部分-->
<div class="place-content">
    <div class="place-wrap-1">
        <div class="place-cc">
            <span>深圳</span>
            <a>[切换城市]</a>
        </div>
        <div class="place-wrap place-shadow">
            <div class="place-tab">
                <ul>
                    <?php foreach($data as $val): ?>
                    <li><a id="t<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="n1" class="place-names">
                <?php foreach($list as $val): if($val['address_id'] == '1'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n2" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '2'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n3" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '3'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n4" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '4'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n5" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '5'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n6" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '6'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n7" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '7'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
            <div id="n8" class="place-names n">
                <?php foreach($list as $val): if($val['address_id'] == '8'): ?>
                <div class="name-item">
                    <a class="place-link" href="<?php echo url('front/shops/shop',['id'=>$val['user_id']]); ?>">
                        <?php echo $val['name']; ?>
                    </a>
                </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
    </div>
    <!--footer部分-->
    <div class="footer-content">
    <div class="footer-content-entrance">
        <a class="footer-content-link" href="../../about.html-p=guanyuwomen.htm">关于我们</a>
        <span class="footer-content-separator">|</span>
        <a class="footer-content-link footer-content-weixing">关注微信
            <img class="weixin-pic" src="/static/front/image/qr_code.jpg">
        </a>
        <span class="footer-content-separator">|</span>
        <a class="footer-content-link" href="../../about.html-p=tousujianyi.htm">投诉建议</a>
        <span class="footer-content-separator">|</span>
        <a class="footer-content-link kaidian_address" href="../../about.html-p=shangjiaruzhu.htm">商家入驻</a>
    </div>
    <div class="footer-content-copyright">©2016 dingfanzu.com
        <a target="_blank">京ICP证020666号</a>
    </div>
</div>

    <!--购物车-->
    <div class="shop-cart shadow n">
    <div class="shop-head">
        购物车<a class="shop-clear">[清空]</a>
    </div>
    <div class="shop-body">
        <div class="isnull">
            <span></span>
            <b>购物车空空如也</b>
        </div>
    </div>
    <div class="shop-bottom">
        <div class="bottom-price fl">总计：￥
            <label class="price">32</label>
        </div>
        <div class="bottom-icon"></div>
        <div class="bottom-pay fr">
            <a id="cart-pay">结算</a>
        </div>
    </div>
</div>
<script>
    $('#cart-pay').click(function () {
        $('.shop-item').each(function(){

        });
    });
</script>


<!--
<div class="shop-item-wrap">
    <div class="shop-item" item-id="5">
        <div class="item-name fl" style="width: 135px;">红烧小强</div>
        <div class="item-count fl">
            <button class="minus">-</button>
            <input type="text" value="3" readonly="readonly" maxlength="3">
            <button class="plus">+</button>
        </div>
        <div class="item-price fl" per-price="32.00">￥<label>96</label></div>
    </div>
</div>
<div class="shop-item-wrap">
    <div class="shop-item" item-id="6">
        <div class="item-name fl" style="width: 135px;">蝴蝶烧饼</div>
        <div class="item-count fl">
            <button class="minus">-</button>
            <input type="text" value="2" readonly="readonly" maxlength="3">
            <button class="plus">+</button>
        </div>
        <div class="item-price fl" per-price="1.00">￥<label>2</label></div>
    </div>
</div>
<div class="shop-item-wrap">
    <div class="shop-item" item-id="7">
        <div class="item-name fl" style="width: 135px;">清蒸平头哥</div>
        <div class="item-count fl">
            <button class="minus">-</button>
            <input type="text" value="1" readonly="readonly" maxlength="3">
            <button class="plus">+</button>
        </div>
        <div class="item-price fl" per-price="12.00">￥<label>12</label></div>
    </div>
</div></div>-->


    <ul  class="place-nav n">
        <li><a class="city">北京</a></li>
        <li><a class="city">天津</a></li>
    </ul>
</div>

<div id="myModal" class="reveal-modal">
    <!--登录-->
    <div id="loginform" class="loginform n">
    <div>
        <div class="loginformfield">
            <span class="form-icon"><img src="/static/front/image/logo-50-50.jpg.png"></span>
        </div>
        <div class="loginformfield">
            <span class="form-title">
                <h2>使用手机号登录订饭组</h2>
            </span>
        </div>
        <div class="loginformfield">
            <label class="field-name">手机号:</label>
            <input id="phone-1" placeholder="请输入您的手机号" name="phone">
            <div class="loginformfield-hint form-error">
                <span id="login-phone-error"></span>
            </div>
        </div>
        <div class="loginformfield">
            <label class="field-name">密码:</label>
            <span class="fp">
                <a href="#" id="forget-password" class="forget-password">忘记密码？</a>
            </span>
            <input id="login-pwd" type="password" placeholder="密码" name="pwd">
            <div class="loginformfield-hint form-error">
                <span id="login-pwd-error"></span>
            </div>
        </div>
    </div>
    <div class="loginform-buttons">
        <a id="checkin" class="save-btn" href="#">登录</a>
        <span >还没有账号？<a id="register">创建一个</a></span>
    </div>
</div>
<script>
    $('#checkin').click(function(){
        var phone = $('[name="phone"]').val();
        var pwd = $('[name="pwd"]').val();
        $.ajax({
            type:"post",
            url:'http://www.takeout.com/v1/login',
            data:{
                phone:phone,
                pwd:pwd
            },
            dataType:"json",
            success:function(res){
                if(res.errcode === 0){
                    $('#header-login').hide();
                    $('#user').css('display','block');
                    $('#myModal').css('visibility','hidden');
                    $('.reveal-modal-bg').css('display','none');
                    //写cookie并放在根目录
                    $.cookie('userId',res.data,{path:'/'});
                }else{
                    alert(res.msg);
                }
            }
        });
    });
</script>
    <!--注册-->
    <form id="form">
<div id="registerform" class="registerform n">
    <div>
        <div class="loginformfield">
            <span class="form-icon"><img src="/static/front/image/logo-50-50.jpg.png"></span>
        </div>
        <div class="loginformfield">
            <span class="form-title">
                <h2>创建新账号</h2>
            </span>
        </div>
        <div class="loginformfield">
            <label class="field-name">手机号:</label>
            <input id="phone-2" placeholder="请输入您的手机号" name="phone">
            <div class="loginformfield-hint form-error">
                <span id="register-phone-error"></span>
            </div>
        </div>
        <div class="loginformfield field-confirm-code">
            <label class="field-name">验证码:</label>
            <input   id="register-confirm-code" placeholder="请输入验证码">
            <button id="register-code" class="phone-code-btn">获取验证码</button>
            <input type="hidden" id="register-hid-code">
            <div class="loginformfield-code-hint form-error">
                <span id="register-code-error"></span>
            </div>
        </div>
        <div class="loginformfield">
            <label class="field-name">请输入密码:</label>
            <input id="register-pwd" type="password" placeholder="请输入6位以上字母或数字密码" name="pwd">
            <div class="loginformfield-hint form-error">
                <span id="register-pwd-error"></span>
            </div>
        </div>
    </div>
    <div class="loginform-buttons">
        <a id="create" class="save-btn" href="#">创建</a>
        <span >已经有账号？<a id="login">登录</a></span>
    </div>
</div>
</form>
<script>
    $('#create').click(function(){
        $.ajax({
            type:"post",
            url:"http://www.takeout.com/v1/register",
            data:$('#form').serialize(),
            dataType:"json",
            success:function(res){
                alert(res.msg);
            }
        });
    })
</script>
    <!--账户设置--->
    <div id="chpwdform" class="chpwdform n">
        <div>
            <div class="loginformfield">
                <span class="form-icon"><img src="/static/front/image/logo-50-50.jpg.png"></span>
            </div>
            <div class="loginformfield">
                <span class="form-title">
                    <h2>修改密码</h2>
                </span>
            </div>
            <div class="loginformfield">
                <label class="field-name">手机号:</label>
                <input id="phone-3" placeholder="请输入您的手机号">
                <div class="loginformfield-hint form-error">
                    <span id="chpwd-phone-error"></span>
                </div>
            </div>
            <div class="loginformfield field-confirm-code">
                <label class="field-name">验证码:</label>
                <input  id="chpwd-confirm-code"  placeholder="请输入验证码">
                <button id="chpwd-code" class="phone-code-btn">获取验证码</button>
                <input type="hidden" id="chpwd-hid-code">
                <div class="loginformfield-code-hint form-error">
                    <span id="chpwd-code-error"></span>
                </div>
            </div>
            <div class="loginformfield">
                <label class="field-name">新密码:</label>
                <input id="chpwd-pwd" type="password" placeholder="请输入6位以上字母或数字密码">
                <div class="loginformfield-hint form-error">
                    <span id="chpwd-pwd-error"></span>
                </div>
            </div>
        </div>
        <div class="loginform-buttons">
            <a id="chpwd" class="save-btn" href="#">确定</a>
            <span >没有忘记密码？<a id="back-login">返回</a></span>
        </div>
    </div>
    <a class="close-reveal-modal"><img src="/static/front/image/icon_close.png" height="24" width="24"></a>
</div>

<!--提示框-->
<div id="alertModel" class="alertModel" >
    <a id="alert" data-reveal-id="alertModel" data-animation="fade"></a>
    <span id="alert-msg"></span>
    <button id="btn-ok" class="btn">知道了</button>
    <a class="close-reveal-modal"><img src="/static/front/image/icon_close.png" height="24" width="24"></a>
</div>
<script src="/static/front/js/common.js"></script>
<script src="/static/front/js/md5.js"></script>
<script src="">///static/front/js/myInfo.js</script>
<script src="">///static/front/js/login.js</script>
<script src="/static/front/js/cart.lib.js"></script>
<script src="/static/front/js/cart.js"></script>
<script src="/static/front/js/header.js-v=1.js"></script>
<script src="/static/front/js/footer.js"></script>
<script type="text/javascript">
    $(function(){

        //初始化购物车
        initCart();

        //footer
        processFooter();

        //地址悬浮
        $(".place-cc a,.place-nav").hover(function() {
            $('.place-nav').show();
        }, function() {
            $('.place-nav').hide();
        });

        //购物车相关
        var shopCartWidth=$(".shop-cart").width();
        //默认隐藏购物车
        $(".shop-cart,.shop-bottom").css("right",-shopCartWidth);
        var mRight=-shopCartWidth;

        $("#cart").click(function(){
            $('.shop-cart').show();
            //适配购物车
            processShopItem();

            shopCartWidth=$(".shop-cart").width();
            if(mRight=='0px'){
                mRight=-shopCartWidth;
                $(".shop-cart,.shop-bottom").animate({right:mRight},200);
            }
            else{
                mRight='0px';
                $(".shop-cart,.shop-bottom").animate({right:mRight},200);
            }
        });




        //中间高
        var zw=$(window).width();
        var middleWidth=$('.place-wrap').width();
        var middleHeight=$('.place-wrap').height();
        var marginLeft=(zw-middleWidth)/2;
        $(".place-wrap-1").css("marginLeft",marginLeft);
        $(".place-wrap-1").show();

        //地址选择悬浮
        $(".place-nav").css("left",marginLeft+32);//再加32
        //地址点击
        $('.city').click(function(event) {
            if($(this).text()!="北京"){
                showAlert("该城市未开通");
            }else{
                window.location.reload();
            }
        });

        //弹出动画
        $(".place-wrap").animate({"opacity":"0.9"}, 200);




        $(window).resize(function(){
                    //中间高
                    var zw=$(window).width();
                    var middleWidth=$('.place-wrap').width();
                    var middleHeight=$('.place-wrap').height();
                    var marginLeft=(zw-middleWidth)/2;
                    $(".place-wrap-1").css("marginLeft",marginLeft);
                    //地址选择悬浮
                    $(".place-nav").css("left",marginLeft+32);

                    //适配购物车
                    processShopItem();

                    $('.shop-cart').hide();
                    var shopCartWidth=$(".shop-cart").width();
                    //默认隐藏购物车
                    $(".shop-cart,.shop-bottom").css("right",-shopCartWidth);
                    mRight=-shopCartWidth;

                    processFooter();
                });


                //tab点击事件
                $('.place-tab a').click(function(){
                    //alert($(this).data('id'));
                    //变样式
                    var cl=$(this).parents('.place-tab').find('a');
                    cl.removeClass('alive');
                    $(this).addClass('alive');
                    var pid=$(this).attr('id');
                    $('.place-names').hide();
                    var n="#"+pid.replace('t','n');
                    $(n).show();
                });
            });

            function processFooter(){
                var zh=$(document.body).height();
                $(".footer-content").css('top', zh-60);
                $(".footer-content").show();
            }
        </script>
    </body>
</html>