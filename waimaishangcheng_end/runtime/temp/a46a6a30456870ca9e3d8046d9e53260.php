<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\takeout.com\public/../application/front\view\order\pay2.html";i:1555056401;}*/ ?>
<html><head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <title>微信支付</title>
    <style>
        html {
            font-size: 62.5%;
            font-family: 'helvetica neue',tahoma,arial,'hiragino sans gb','microsoft yahei',Simsun,sans-serif
        }

        blockquote,body,button,code,dd,div,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,hr,input,legend,li,ol,p,pre,td,textarea,th,ul {
            margin: 0;
            padding: 0
        }

        body {
            line-height: 1.333;
            font-size: 12px
        }

        h1,h2,h3,h4,h5,h6 {
            font-size: 100%;
            font-family: arial,'hiragino sans gb','microsoft yahei',Simsun,sans-serif
        }

        button,input,select,textarea {
            font-size: 12px;
            font-weight: 400
        }

        button,input[type=button],input[type=submit],label,select {
            cursor: pointer
        }

        table {
            border-collapse: collapse;
            border-spacing: 0
        }

        address,caption,cite,code,dfn,em,th,var {
            font-style: normal;
            font-weight: 400
        }

        li {
            list-style: none
        }

        caption,th {
            text-align: left
        }

        q:after,q:before {
            content: ''
        }

        abbr,acronym {
            border: 0;
            font-variant: normal
        }

        sup {
            vertical-align: text-top
        }

        sub {
            vertical-align: text-bottom
        }

        a img,fieldset,iframe,img {
            border-width: 0;
            border-style: none
        }

        img {
            -ms-interpolation-mode: bicubic
        }

        textarea {
            overflow-y: auto
        }

        legend {
            color: #000
        }

        a:link,a:visited {
            text-decoration: none
        }

        hr {
            height: 0
        }

        .clearfix:after {
            content: "\200B";
            display: block;
            height: 0;
            clear: both
        }

        a {
            color: #328CE5
        }

        a:hover {
            color: #2b8ae8;
            text-decoration: none
        }

        a.hit {
            color: #C06C6C
        }

        a:focus {
            outline: 0
        }

        .hit {
            color: #8DC27E
        }

        .txt_auxiliary {
            color: #A2A2A2
        }

        .clear:after,.clear:before {
            content: "";
            display: table
        }

        .clear:after {
            clear: both
        }

        .body,body {
            background: #f7f7f7;
            height: 100%
        }

        .mod-title {
            height: 60px;
            line-height: 60px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            background: #fff
        }

        .mod-title .ico-wechat {
            display: inline-block;
            width: 41px;
            height: 36px;
            background: url(../../ac/shop_cart/wechat-pay.png) 0 -115px no-repeat;
            vertical-align: middle;
            margin-right: 7px
        }

        .mod-title .text {
            font-size: 20px;
            color: #333;
            font-weight: 400;
            vertical-align: middle
        }

        .mod-ct {
            width: 610px;
            padding: 0 135px;
            margin: 15px auto 0;
            background: url(../../images/shop_cart/wave.png) top center repeat-x #fff;
            text-align: center;
            color: #333;
            border: 1px solid #e5e5e5;
            border-top: none
        }

        .mod-ct .order {
            font-size: 20px;
            padding-top: 30px
        }

        .mod-ct .amount {
            font-size: 48px;
            margin-top: 20px
        }

        .mod-ct .qr-image {
            margin-top: 30px
        }

        .mod-ct .qr-image img {
            width: 230px;
            height: 230px
        }

        .mod-ct .detail {
            margin-top: 60px;
            padding-top: 25px
        }

        .mod-ct .detail .detail-ct {
            display: none;
            font-size: 14px;
            text-align: right;
            line-height: 28px
        }

        .mod-ct .detail .detail-ct dt {
            float: left
        }

        .mod-ct .detail-open {
            border-top: 1px solid #e5e5e5
        }

        .mod-ct .detail .arrow {
            padding: 6px 34px;
            border: 1px solid #e5e5e5
        }

        .mod-ct .detail .arrow .ico-arrow {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url(../../ac/shop_cart/wechat-pay.png) -25px -100px no-repeat
        }

        .mod-ct .detail-open .arrow .ico-arrow {
            display: inline-block;
            width: 20px;
            height: 11px;
            background: url(../../ac/shop_cart/wechat-pay.png) 0 -100px no-repeat
        }

        .mod-ct .detail-open .detail-ct {
            display: block
        }

        .mod-ct .tip {
            margin-top: 40px;
            border-top: 1px dashed #e5e5e5;
            padding: 30px 0;
            position: relative
        }

        .mod-ct .tip .ico-scan {
            display: inline-block;
            width: 56px;
            height: 55px;
            background: url(../image/wechat-pay.png) no-repeat;
            vertical-align: middle
        }

        .mod-ct .tip .tip-text {
            display: inline-block;
            vertical-align: middle;
            text-align: left;
            margin-left: 23px;
            font-size: 16px;
            line-height: 28px
        }

        .mod-ct .tip .dec {
            display: inline-block;
            width: 22px;
            height: 45px;
            background: url(../image/wechat-pay.png) 0 -55px no-repeat;
            position: absolute;
            top: -23px
        }

        .mod-ct .tip .dec-left {
            background-position: 0 -55px;
            left: -136px
        }

        .mod-ct .tip .dec-right {
            background-position: -25px -55px;
            right: -136px
        }

        .foot {
            text-align: center;
            margin: 30px auto;
            color: #888;
            font-size: 12px;
            line-height: 20px;
            font-family: simsun
        }
        .foot .link {
            color: #0071ce
        }
        #MAXIM {
            content: "abe20170418182028"
        }

    </style>
</head>
<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico-wechat"></span><span class="text">微信支付</span>
    </h1>
    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount">￥<?php echo $data['total_price']; ?></div>
        <div class="qr-image" style="">
            <img style="width:230px;height:230px;" id="billImage" src="<?php echo url('front/order/createQrcode'); ?>?p=<?php echo $data['total_price']; ?>&o=<?php echo $data['order_id']; ?>">
        </div>
        <!--detail-open 加上这个类是展示订单信息，不加不展示              -->
        <div class="detail detail-open" id="orderDetail" style="">
            <dl class="detail-ct" style="display: block;">
                <dt>商家</dt>
                <dd id="storeName"><?php echo $data['shop_name']; ?></dd>
                <dt>商品名称</dt>
                <dd id="productName">912750350账户充值</dd>
                <dt>交易单号</dt>
                <dd id="billId"><?php echo $data['order_id']; ?></dd>
                <dt>创建时间</dt>
                <dd id="createTime"><?php echo $data['create_time']; ?></dd>
            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>
        <div class="tip">
            <span class="dec dec-left"></span>
            <span class="dec dec-right"></span>
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用微信扫一扫</p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>
    </div>

    <div class="foot">
        <div class="inner">
            <p>您若对上述交易有疑问</p>
            <p>请联系腾讯云企业QQ <a href="javascript:void(0);" class="link">800033878</a></p>
        </div>
    </div>
</div>
</body>
</html>