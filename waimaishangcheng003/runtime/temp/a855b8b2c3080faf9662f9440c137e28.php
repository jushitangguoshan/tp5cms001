<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"E:\takeout.com\public/../application/admin\view\shop\shop_add.html";i:1554715329;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加店铺</title>
<link rel=stylesheet href="/static/admin/css/styles/reset.css">
<link rel="stylesheet" href="/static/admin/css/xadmin.css">
<link rel="stylesheet" href="/static/admin/css/bootstrap-admin.css">
<script type="text/javascript" src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
<link href="/static/admin/css/global.css"  rel="stylesheet"  type="text/css"/>
<link href="/static/admin/css/backstage.css"  rel="stylesheet"  type="text/css"/>
<link rel="stylesheet" href="/static/layui/css/layui.css">
<script src="/static/layui/layui.js"></script>
</head>
<body> 
<span class="main-title">添加店铺</span>
<div id="main-tip"></div>
<div class="form-add">
<form id="form1" class="layui-form" action="<?php echo url('shop/shop_add'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">店铺名称</label>
        <div class="layui-input-block">
            <input type="text" name="shopName" shopName  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">店铺公告</label>
        <div class="layui-input-block">
            <input type="text" name="shopTip" shopName  lay-verify="required" placeholder="店铺公告" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">店铺状态</label>
        <div class="layui-input-block">
            <input type="radio" name="shopState" value="1" title="营业">
            <input type="radio" name="shopState" value="0" title="休息" checked>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">电话</label>
        <div class="layui-input-block">
            <input type="text" name="shopPhone" shopName  lay-verify="required" placeholder="请输入手机号" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">店铺楼宇</label>
        <div class="layui-input-block">
            <input type="text" name="shopBlock" shopName  lay-verify="required" placeholder="店铺楼宇" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width: 100px">店铺楼层</label>
        <div class="layui-input-block">
            <input type="text" name="shopFloor" shopName  lay-verify="required" placeholder="店铺楼层" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="test1">
                <i class="layui-icon"  name="myFile"></i>店铺icon
            </button>
            <button class="layui-btn" id="btn" lay-submit lay-filter="formDemo">添加店铺</button>
        </div>
    </div>
</form>
</div>

<script type="text/javascript" src="/static/admin/js/jquery-1.8.3.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;
    });
    layui.use('upload', function(){
        var upload = layui.upload;
        //执行实例
        var uploadInst = upload.render({
            elem: "#test1", //绑定元素
            url: "<?php echo url('shop/shop_add'); ?>", //上传接口
            accept:"images",
            auto:false,
            bindAction:"#btn",
            done: function(res){
                //上传完毕回调
            }
            ,error: function(){
                //请求异常回调
            }
        });
    });
</script>
<script type="text/javascript">
 $(document).ready(function(){ 
   $("#form1").submit(function () {
    if(isValid()){ 
        return true;
    }else{ 
        return false;
    }
 });
});  
 function isValid(){ 
    if($("input[name='shopName']").val().length<=0){ 
        $("#main-tip").html('名称不能为空');
        $("#main-tip").css('display', 'inline-block');
        return false;
    }
    if($("input[name='shopTip']").val().length<=0){ 
        $("#main-tip").html('公告不能为空');
        $("#main-tip").css('display', 'inline-block');
        return false;
    }
    if($("input[name='myFile']").val().length<=0){ 
        $("#main-tip").html('图片不能为空');
        $("#main-tip").css('display', 'inline-block');
        return false;
    }
    $("#main-tip").hide();
    return true;
 }
</script>
</body>  
</html>