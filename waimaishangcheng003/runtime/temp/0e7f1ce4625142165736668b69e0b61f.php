<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\takeout.com\public/../application/admin\view\categorys\category_add.html";i:1554715329;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel=stylesheet href="/static/admin/css/reset.css">
    <link href="/static/admin/css/backstage.css"  rel="stylesheet"  type="text/css"/>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script src="/static/layui/layui.js"></script>
</head>
<body>
    <span class="main-title">添加分类</span>
    <div id="main-tip"></div>
    <div class="form-add">
        <form class="layui-form layui-form-pane" action="" onclick="return false;">
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-input-block">
                    <input type="text" name="category_name" lay-verify="required|category_name" placeholder="请输入分类名称" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">权重</label>
                <div class="layui-input-block">
                    <input type="text" name="weight" lay-verify="required|number|weight" placeholder="请输入权重"  class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit lay-filter="addCategory" >提交</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="/static/admin/js/jquery-1.8.3.js"></script>
<script type="text/javascript">
    layui.use(['form'], function(){
        var form = layui.form,
        layer = layui.layer,
        $ = layui.jquery;
        //自定义验证规则
        form.verify({
            category_name: function(value){
                 if( !/^[a-zA-Z\/]*$|^[\u4E00-\u9FA5]*$/.test(value) ){
                    return '栏目名称不能有特殊字符';
                }
                if( /^\d+\d+\d$/.test(value) ){
                    return '栏目名称不能全为数字';
                }
            }
            ,weight: function (value) {
                if(value>1000 || value<1){
                    return '权重必须为1000以内的正整数且大于0';
                }
            }
        });
        //监听form表单提交事件
        form.on('submit(addCategory)', function(data){
            var param=data.field;//定义临时变量获取表单提交过来的数据，非json格式
            $.ajax({
                url:"<?php echo url('admin/categorys/categoryAddHandle'); ?>",
                type:'post',//method请求方式，get或者post
                dataType:'json',//预期服务器返回的数据类型
                data:JSON.stringify(param),//表格数据序列化
                contentType: "application/json; charset=utf-8",
                success:function(res){
                    if(res.code===100){
                        layer.alert('添加栏目成功',{icon:1});
                        // 清空表单 （“addGoodsForm”是表单的id）
                        $("form")[0].reset();
                        layui.form.render();
                    }else{
                        layer.alert(res.msg,{icon: 5});
                    }
                },
                error:function(){
                    layer.alert('添加失败！！！',{icon:5});
                }
            });
        });//end form
    });

</script>

</html>