<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\takeout.com\public/../application/admin\view\goods\goods_list.html";i:1554715329;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品列表</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/admin/js/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
</head>
<body>
<div class="layui-card">
    <div class="layui-card-header">商品列表</div>
    <div class="layui-card-body">
        <table id="goods_list" lay-filter="test"></table>
    </div>
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="edit">修改</a>
    </script>
</div>
<script>
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#goods_list',
            height: 312,
            url: '<?php echo url("admin/goods/showList"); ?>',//数据接口
            page: true, //开启分页
            cols: [[
                /*{type: 'checkbox', fixed: 'left'},*/
                {field: 'id', title: '商品编号', width:100, sort: true, fixed: 'left'},
                {field: 'goods_name', title: '商品名称', width:150},
                {field: 'belong_category_id', title: '商品分类', width:120, sort: true},
                {field: 'belong_store_id', title: '所属店铺', width:150},
                {field: 'price', title: '价格', width: 100},
                {field: 'create_time', title: '发布时间', width: 150, sort: true},
                {field: 'image', title: '商品图像', width: 150, sort: true, align: 'center',templet:'<div><img style="height:50px;width:50px;" src="{{d.image}}"></div>'},
                {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 120}
            ]]
        });
        table.on('tool(test)', function(obj){
            console.log(obj);
            var id = obj.data.id;
            var tr = obj.tr;
            var layEvent = obj.event;
            if(layEvent === 'del'){
                layer.confirm('您确定要删除此商品吗？', {
                    btn: ['确定','取消']
                },function() {
                    $.ajax({
                        type: "post",
                        url: "<?php echo url('admin/goods/del'); ?>",
                        data: "id=" + id,
                        dataType: "json",
                        success: function (res) {
                            if (res.code === 0) {
                                layer.msg(res.msg, {icon: 6});
                                tr.remove();
                            } else {
                                layer.msg(res.msg, {icon: 5});
                            }
                        }
                    });
                });
            }else if(layEvent === 'edit'){
                layer.open({
                    type: 2,
                    title: '修改商品',
                    area: ['650px', '450px'],
                    fixed: false, //不固定
                    maxmin: true,
                    btn: ['保存','取消'],
                    content: '<?php echo url("admin/goods/edit_goods"); ?>?act='+id,
                    yes:function (index) {
                        var body = layer.getChildFrame('body', index);
                        var value = body.find("form").serialize();
                        $.ajax({
                            type:"post",
                            url:"<?php echo url('admin/goods/edit'); ?>",
                            data:value,
                            dataType:"json",
                            success:function(res){
                                if(res.code === 0){
                                    layer.msg(res.msg, {icon: 6});
                                    window.location.reload();
                                }else if(res.code === 300){
                                    layer.msg(res.msg, {icon: 5});
                                }else{
                                    layer.msg(res.msg, {icon: 5});
                                }
                            }
                        });
                        layer.closeAll();
                    }
                });
            }
        });
    });
</script>
</body>
</html>