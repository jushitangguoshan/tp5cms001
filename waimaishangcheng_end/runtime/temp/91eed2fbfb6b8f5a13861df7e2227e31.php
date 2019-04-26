<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\takeout.com\public/../application/admin\view\shop\shop_list.html";i:1554715341;}*/ ?>

<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/admin/js/cookie.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="x-body">
    <table class="layui-table x-admin" id="table">
        <script type="text/html" id="barDemo">
            <button class="layui-btn layui-btn layui-btn-xs" onclick="x_admin_show('编辑','<?php echo url('shop/shop_edit'); ?>?id={{d.id}}')">
                <i class="layui-icon" lay-event="edit">&#xe642;</i>编辑
            </button>
            <button class="layui-btn-danger layui-btn layui-btn-xs" onclick="x_admin_show('删除','<?php echo url('shop/shop_del'); ?>?id={{d.id}}')">
                <i class="layui-icon" lay-event="delete">&#xe640;</i>删除
            </button>
        </script>
    </table>
</div>
<script>
    layui.use('table', function(){
        var table = layui.table;
        //第一个实例
        table.render({
            elem: '#table'
            ,height: 400
            ,url: "<?php echo url('shop/get_shop_list'); ?>" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'name', title: '店铺名称', width:80}
                ,{field: 'id', title: '店铺id', width:80}
                ,{field: 'status', title: '店铺状态', width:80}
                ,{field: 'notice', title: '店铺公告', width:80}
                ,{field: 'image', title: '店铺icon', width: 177,templet:'<div><img src="/{{d.image}}" alt=""></div>'}
                ,{fixed: 'right', width:200, align:'center', toolbar: '#barDemo'}
            ]]
        });
    });
</script>
<script>
    var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>

</html>