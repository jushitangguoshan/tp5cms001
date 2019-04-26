<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\takeout.com\public/../application/admin\view\home\index.html";i:1555066792;}*/ ?>
<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.1</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>

    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/admin/js/cookie.js"></script>
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index.html">订饭组</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;" id="adminName"></a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('home/back'); ?>">退出</a>
        </li>
        <li class="layui-nav-item to-index"><a href="http://www.takeout.com/front/home/index.html">前台首页</a></li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li id="goods" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>商品管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li date-refresh="1">
                        <a _href="<?php echo url('admin/goods/add_goods'); ?>">
                            <i class="iconfont"> </i>
                            <cite>添加商品</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('admin/goods/goods_list'); ?>">
                            <i class="iconfont"> </i>
                            <cite>商品列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li id="gory" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('admin/categorys/category_add'); ?>">
                            <i class="iconfont"></i>
                            <cite>添加分类</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('admin/categorys/category_list'); ?>">
                            <i class="iconfont"></i>
                            <cite>分类列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li id="order" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('admin/orderinquiry/index'); ?>">
                            <i class="iconfont"> </i>
                            <cite>订单查询</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li id="user" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('admin/user/member_list'); ?>">
                            <i class="iconfont"> </i>
                            <cite>用户列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li id="admin" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('admin/admin/admin_add'); ?>">
                            <i class="iconfont"> </i>
                            <cite>添加管理员</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('admin/admin/admin_list'); ?>">
                            <i class="iconfont"> </i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('admin/admin/adminRoleList'); ?>">
                            <i class="iconfont"> </i>
                            <cite>角色列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li id="shop" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>店铺管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href=<?php echo url('admin/shop/shop_add'); ?>>
                            <i class="iconfont"> </i>
                            <cite>添加店铺</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('admin/shop/shop_list'); ?>">
                            <i class="iconfont"> </i>
                            <cite>店铺列表</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li id="orderList" style="display: none">
                <a href="javascript:;">
                    <i class="iconfont"></i>
                    <cite>接单管理</cite>
                    <i class="iconfont nav_right"></i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('admin/order/orderHandleList'); ?>">
                            <i class="iconfont"></i>
                            <cite>开始接单</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('admin/order/orderHistoryList'); ?>">
                            <i class="iconfont"> </i>
                            <cite>历史接单</cite>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title" id="title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='<?php echo url("admin/home/welcome"); ?>' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->

<!-- 底部结束 -->
<script>
    $.ajax({
        type: "POST",
        url: "<?php echo url('home/loginIndex'); ?>",
        success: function(res){
            console.log(res);
            var html = '';
            if ( res.code === 1 ){
                $('#adminName').html(res.name);
                $('#goods').show();
                $('#orderList').show();
                $('#order').show();
                $('#gory').show();
                $('#user').show();
                $('#admin').show();
                $('#shop').show();
            }else if ( res.code === 3 ){
                $('#adminName').html(res.name);
                $('#order').show();
                $('#shop').show();
                html += ' <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>';
                $('#title').html(html);
            }else if ( res.code === 2 ){
                $('#adminName').html(res.name);
                $('#goods').show();
                $('#gory').show();
                $('#orderList').show();
                html += ' <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>';
                $('#title').html(html);
            }
        }
    });
</script>
</body>
<!doctype html>