<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\takeout.com\public/../application/admin\view\login\index.html";i:1555066792;}*/ ?>
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
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/admin/js/cookie.js"></script>

</head>
<body class="login-bg">
    <div class="login layui-anim layui-anim-up">
        <div class="message">x-admin2.0-管理登录</div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form" onclick="return false;">
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" id="sub" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>
    <script>
        $(function  () {
            layui.use('form', function(){
                var form = layui.form;
                form.on('submit(login)', function(data){
                    var name = $('[name="username"]').val();
                    var pwd = $('[name="password"]').val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo url('login/login_index'); ?>",
                        data: "name=" + name +"&pwd=" + pwd,
                        success: function(res){
                            console.log(res);
                            if( res.code === 0 ){
                                layer.msg(JSON.stringify(res.msg),function(){});
                            }else if( res.code === 1 ){
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo url('home/isPost'); ?>",
                                    data: "id=1",
                                    success: function(res){
                                        window.location.href="<?php echo url('home/index'); ?>";
                                    },
                                });
                                layer.msg(JSON.stringify(res.msg),function(){});
                                //location.href="<?php echo url('home/index'); ?>?id=1";
                            }else if( res.code === 2 ){
                                layer.msg(JSON.stringify(res.msg),function(){});
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo url('home/isPost'); ?>",
                                    data: "id=2",
                                    success: function(res){
                                        window.location.href="<?php echo url('home/index'); ?>";
                                    }
                                });
                                //location.href="<?php echo url('home/index'); ?>?id=2";
                            }else if( res.code === 3 ){
                                layer.msg(JSON.stringify(res.msg),function(){});
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo url('home/isPost'); ?>",
                                    data: "id=3",
                                    success: function(res){
                                        window.location.href="<?php echo url('home/index'); ?>";
                                    }
                                });
                                //location.href="<?php echo url('home/index'); ?>?id=3";
                            }else if( res.code === 4 ){
                                location.href="<?php echo url('login/choose'); ?>";
                            }
                        }
                    });
                });
            });
        })
    </script>
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>