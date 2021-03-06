<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\thinkphp5\mytest\public/../application/admin\view\home\login.html";i:1552555560;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台登录 - 内容管理系统</title>
	<link rel="stylesheet" href="/static/admin/login/css/dashicons.css">
	<link rel="stylesheet" href="/static/admin/login/css/layout.css">
	<script src="/static/admin/login/js/login.js"></script>
	<script src="/static/admin/login/js/jquery.cookie.js"></script>
	<script>
	    if(top.location !== self.location){
		   top.location = self.location;
	    }
	</script>
</head>
<body>
<div class="top">
	<div class="top-title icon-home">内容管理系统</div>
	<div class="top-right">
		<a href="../" target="_blank">前台首页</a>
	</div>
</div>
<div class="login">
	<div class="login-wrap">
		<a href="../" target="_blank" class="login-logo" title="点击查看前台首页"></a>
		<div class="tips"></div>
		<div class="login-box">
			<form method="post" onsubmit="return false;">
				<?php echo token(); ?>
				<table>
					<tr>
						<th>用户名：</th>
						<td><input type="text" name="username" value=""></td>
					</tr>
					<tr>
						<th>密　码：</th>
						<td><input type="password" name="password"></td>
					</tr>
					<tr class="captcha" style="display: none">
						<th>验证码：</th>
						<td><input type="text" name="captcha"></td></tr>
					<tr class="captcha"  style="display: none">
						<th></th>
						<td><img src="<?php echo captcha_src(); ?>" id="captcha" alt="验证码" title="点击刷新验证码"></td>
					</tr>
					<tr>
						<th></th>
						<td><input type="button" id="submit" value="登录"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script>
//验证码点击刷新
(function(){

    var $img = $("#captcha");
    var src = $img.attr("src")+"?_=";
    $img.click(function(){
	   $img.attr("src",src+Math.random()); //添加随机数防止浏览器缓存图片
    });
    $('#submit').click(function(){
        //判断数据是否为空
        if( !isNull() ){return;}
        $.ajax({
            url:"<?php echo url('admin/module/loginHandle'); ?>",
            type:'post',
		  data:$('form').serialize(),
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code){
                    alert('登录成功，点击确定跳转后台')
                    window.location.href=res.data;
                }else{
                    //判断如果是因为密码错误则显示验证码
                    if($.cookie('loginUser') !=null){
                        $('.captcha').css('display','');
                    }
                    alert(res.msg);
			 }
            }
        })
    })
    function isNull(){
		if($('[name="username"]').val()=='' || $('[name="password"]').val()=='' ){
			alert('账户秘密不能为空1');
			return false;
		}
		if($.cookie('loginUser') != null){
		    if($('[name="captcha"]').val()==''){
                  alert('验证码不能为空');
                  return false;
		    }
		}
	   return true;
    }
})();
</script>
</body>
</html>