<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\takeout.com\public/../application/admin\view\orderinquiry\index.html";i:1554770319;}*/ ?>
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
            <a class="btn btn-link"  onclick="printOrder(152)">打印</a>
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
            ,url: "<?php echo url('admin/orderinquiry/index_list'); ?>" //数据接口
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'order_id', title: '订单编号', width:100}
                ,{field: 'name', title: '名称', width:300}
                ,{field: 'total_price', title: '商品总价', width:80}
                ,{field: 'is_status', title: '是否支付', width:80}
                ,{field: 'pay_way_name', title: '支付方式', width:80}
                ,{field: 'order_status_name', title: '订单状态', width:80}
                ,{field: 'create_time', title: '订单时间', width:150}
                ,{field: 'user_phone', title: '下单人手机号', width:150}
                ,{fixed: 'right', width:80, align:'center', toolbar: '#barDemo'}
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