<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\takeout.com\public/../application/admin\view\admin\admin_list.html";i:1554715329;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/admin/js/cookie.js"></script>
</head>

<body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">后台人员管理</a>
        <a>
          <cite>管理员列表</cite>
        </a>
      </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
             href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i>
        </a>
    </div>
    <div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" name="username" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table" id="admin_table" lay-filter="admin_table"> </table>
    </div>
</body>
<script>
    layui.use(['laydate','table','form','layer'], function () {
        var laydate = layui.laydate,
            table = layui.table,
            form = layui.form,
            layer = layui.layer,
            $ = layui.jquery;
        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });
        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
        //表格渲染
        table.render({
            elem:"#admin_table",
            url:"<?php echo url('admin/admin/getAdminList'); ?>",//数据接口
            page:true,
            cols:[[//表头
                {type: 'checkbox'}
                ,{field: 'id', title: 'ID', width: 50, sort: true, align: 'center'}
                ,{field: 'name', title: "用户名", width: 80 }
                ,{field: 'phone', title: "手机", width: 120, sort: true}
                ,{field: 'email', title: "邮箱", wieth: 120}
                ,{field: 'roles', title: "角色", wieth: 120}
                ,{field: 'status', title: '状态', width: 120, templet: "#statusTpl"}
                ,{field: 'create_time', title: '创建时间', sort: true}
                ,{field: 'update_time', title: '修改时间', sort: true}
                ,{field: 'right', title: '操作', width: 150, align: 'center', templet: "#opeate"}
            ]],
        });
        //监听--状态改变
        form.on('switch(status_switch)',function (data) {
            //是否被选中，true或者false
            var status = data.elem.checked ? 1 : 0;
            var tr = $(data.elem).parents('tr');
            var adminId = $(tr).children().eq(1).text();
            $.ajax({
                url:'<?php echo url('admin/admin/adminUpdateStatus'); ?>',
                type:'post',
                data:{id:adminId,status:status},
                dataType:'json',
                success:function(res){
                    if( res.code===100 ){
                        layer.msg(res.msg, {icon: 1, time: 1000});
                    }else{
                        layer.msg(res.msg, {icon: 1, time: 5});
                    }
                },
                error:function () {
                    layer.msg("修改失败!!!",{icon:5});
                }
            });
        });
        //监听--修改admin信息
        table.on('tool(admin_table)',function (obj) {
            layer.open({
                type: 2,
                title:'修改管理员信息',
                area:['60%','90%'],
                fiexd:false,
                maxmin: true,
                content: '<?php echo url('admin/admin/admin_edit'); ?>?id='+obj.data.id,
                btn:["提交",'关闭'],
                yes:function (index) {
                    var body = layer.getChildFrame('body', index);
                    var value = body.find("form").serialize();
                    $.ajax({
                       url:'<?php echo url('admin/admin/adminEditHandle'); ?>',
                       type:'post',
                       data:value,
                       dataType:'JSON',
                       success:function (res) {
                           if(res.code === 100){
                               layer.msg(res.msg, {icon: 1, time: 2000});
                           }else{
                               layer.msg(res.msg, {icon: 5,time: 2000});
                           }
                           console.log(res.data);
                           obj.update(res.data);
                       },
                       error:function () {
                           layer.msg("修改失败!!!",{icon:5});
                       }
                   });
                },
                cancel:function () {
                    layer.closeAll();
                }
            });
        })
    });
</script>
<script type="text/html" id="statusTpl">
    {{# if(d.status == 1){ }}
    <input type="checkbox" name="switch" lay-text="开启|停用" checked  lay-filter="status_switch" lay-skin="switch">
        <!--<span class="layui-btn layui-btn-normal layui-btn-xs admin_status">启用</span>-->
    {{# }else{ }}
     <input type="checkbox" name="switch" lay-text="开启|停用"  lay-filter="status_switch" lay-skin="switch">
        <!--<span class="layui-btn layui-btn-disabled layui-btn-xs admin_status">已停用</span>-->
    {{#  } }}
</script>

<script type="text/html" id="opeate">
    <a class="layui-btn layui-btn-xs" lay-event="admin_edit" data-id={{d.id}}>编辑</a>
</script>
</html>