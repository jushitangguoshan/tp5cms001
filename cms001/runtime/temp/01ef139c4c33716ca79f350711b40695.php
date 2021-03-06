<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\thinkphp5\mytest\public/../application/admin\view\module\index.html";i:1552371005;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>后台 - 内容管理系统</title>
		<link rel="stylesheet" href="/static/admin/css/dashicons.css">
		<link rel="stylesheet" href="/static/admin/css/layout.css">
		<script src="/static/admin/js/jquery.js"></script>
	</head>
	<body>
		<!-- 顶部导航 -->
		<div class="top">
			<div class="top-title icon-home">内容管理系统</div>
			<div class="top-right">
				<a href="#" class="user"></a>
				<a href="<?php echo url('front/home/index'); ?>" target="_blank">前台首页</a>
				<a href="<?php echo url('home/login'); ?>">退出</a>
			</div>
		</div>
		<!-- 主要区域 -->
		<div class="main">
			<!-- 左侧导航 -->
			<div class="nav">
				<div class="photo icon-admin user"></div>
				<a target="panel" href="<?php echo url('admin/module/cp_index'); ?>" class="jq-nav icon-index curr">主页</a>
				<a target="panel" href="<?php echo url('admin/module/cp_article_edit'); ?>" class="jq-nav icon-add">发布文章</a>
				<a target="panel" href="<?php echo url('admin/module/cp_article'); ?>" class="jq-nav icon-article">文章管理</a>
				<a target="panel" href="<?php echo url('admin/module/cp_category'); ?>" class="jq-nav icon-category" >栏目管理</a>
				<a target="panel" href="<?php echo url('admin/module/cp_user'); ?>" class="jq-nav icon-category super" style="display: none">用户管理</a>
				<a target="panel" href="<?php echo url('admin/module/basedata'); ?>" class="jq-nav icon-category super" style="display: none">数据库字典</a>
				<script>
				    //单击链接，按钮高亮
				    $(".jq-nav").click(function () {
						$(this).addClass("curr").siblings().removeClass("curr");
					});
				</script>
			</div>
			<!-- 内容区域 -->
			<div class="content">
				<iframe src="<?php echo url('admin/module/cp_index'); ?> " frameborder="no" name="panel"></iframe>
			</div>
		</div>

	<script>

		$(function(){
		    init();
		})
		function init(){
		    $.ajax({
			   url:"<?php echo url('admin/module/indexInit'); ?>",
			   type:'post',
			   async:'true',
			   dataType:'json',
			   success:function(res){
                      console.log(res);
                      if(res.data['status']>=100){
                          $('.super').css('display','');
				  }
				  $('.user').html('您好'+res.data['username']);
                  }
		    })
		}
	</script>
	</body>
</html>