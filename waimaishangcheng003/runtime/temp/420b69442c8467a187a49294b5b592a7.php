<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\takeout.com\public/../application/admin\view\user\member_list.html";i:1554715329;}*/ ?>
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

  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
          <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','./member-add.html',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-hide x-admin" id="user_table"></table>
    </div>
    <script>
      layui.use(['laydate','form','table'], function(){
        var laydate = layui.laydate
            ,$ = layui.jquery
            ,table = layui.table
            ,form = layui.form;
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });
        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
        table.render({
            elem:'#user_table'
            ,url:'<?php echo url('admin/user/userList'); ?>'
            ,page:true
            ,cols:[[
                {type: 'checkbox'}
                ,{field:'id', title:"ID", width:50, sort:true}
                ,{field:'nick', title:"昵称", width:100,align:'center'}
                ,{field:'sex', title:"性别", width:100, align:'center', templet:"#sexTpl"}
                ,{field:'username', title:"姓名", width:100,  align:"center"}
                ,{field:'phone', title:'手机号', align:'center'}
                ,{field:'status', title:"状态",  align:'center',templet:"#statusTpl"}
                ,{field:'create_time', title:'创建时间'}
                ,{field: 'right', title: '操作', width: 150, align: 'center', templet: "#opeate"}
            ]]
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }
      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }
      function delAll (argument) {
        var data = tableCheck.getData();
          console.log(data);
        layer.confirm('确认要删除吗？'+data,function(index){

            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
  </body>
<script type="text/html" id="sexTpl">
  {{# if(d.sex == 1 ){ }}
  <input type="button" class="layui-btn layui-btn-normal" disabled value="男">
  {{# }else{ }}
  <input type="button"  class="layui-btn layui-btn-danger" disabled value="女">
  {{#  } }}
</script>
<script type="text/html" id="statusTpl">
  {{# if(d.status == 1){ }}
  <input type="checkbox" name="switch" lay-text="开启|禁用" checked  lay-filter="status_switch" lay-skin="switch">
  {{# }else{ }}
  <input type="checkbox" name="switch" lay-text="开启|禁用"  lay-filter="status_switch" lay-skin="switch">
  {{#  } }}
</script>
  <script type="text/html" id="opeate">
    <a class="layui-btn layui-btn-xs" lay-event="admin_edit" data-id={{d.id}}>编辑</a>
  </script>
</html>