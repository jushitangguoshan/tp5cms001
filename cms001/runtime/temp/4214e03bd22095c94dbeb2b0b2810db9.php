<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\thinkphp5\mytest\public/../application/front\view\home\index.html";i:1552549273;s:54:"D:\thinkphp5\mytest\application\front\view\layout.html";i:1552485071;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<meta name = "keywords" content = "PHP,内容,管理">
	<meta name = "description" content = "欢迎使用 PHP内容管理系统。">
	<title>这是第一篇文章 - 内容管理系统</title>
	<link rel = "stylesheet" href = "/static/front/css/style.css">
	<script src = "/static/front/js/jquery.min.js"></script>
	<script src = "/static/front/js/common.js"></script>
</head>
<body>
	<!--页面顶部-->
	<div class = "top">
		<div class = "top-container">
			<div class = "top-logo">
				<a href = "<?php echo url('home/index'); ?>"><img src = "/static/front/image/logo.png" alt = "内容管理系统"></a>
			</div>
			<?php echo widget('front/category/p_category'); ?>
			<div class = "top-toggle jq-toggle-btn"><i></i><i></i><i></i></div>
		</div>
	</div>
	<!--页面内容-->
<div class="main">
	<!-- 幻灯片模块 -->
	<div class="slide">
		<div class="slide-wrap">
			<ul>
				<li><a href="#"><img src="/static/front/image/20.jpg" alt="点击查看"></a></li>
				<li><a href="#"><img src="/static/front/image/21.jpg" alt="点击查看"></a></li>
				<li><a href="#"><img src="/static/front/image/22.jpg" alt="点击查看"></a></li>
			</ul>
		</div>
		<ul class="slide-circle">
			<li class="on"></li>
			<li></li>
			<li></li>
		</ul>
	</div>	<!-- 文章列表模块 -->
	<div class="main-body">
		<div class="main-wrap">
			<div class="main-left">
				<div class="al">
					<?php foreach($list as $art): ?>
					<div class="al-each">
						<div class="al-info"><a href="<?php echo url('module/show',['id'=>$art['id']]); ?>"><?php echo $art['title']; ?></a></div>
						<div class="al-desc"><?php echo $art['description']; ?></div>
						<div class="al-more">
							<span>作者：<?php echo $art['author']['username']; ?> | 发表于：<?php echo date('Y-m-d H:i:s',strtotime($art['create_time'])); ?></span>
							<a href="<?php echo url('module/show',['id'=>$art['id']]); ?>">查看原文</a>
						</div>
						<div class="al-img">
							<a href="<?php echo url('module/show'); ?>">
								<img src="/static/admin/uploads/<?php echo $art['thumb_url']; ?>" alt="点击阅读文章">
							</a>
						</div>
					</div>
					<?php endforeach; ?>
					<div class="pagelist">
						<?php echo $list->render(); ?>
					</div>
				</div>
			</div>
			<div class="main-right">
				<div class="si">
					<!-- 栏目列表 -->
					<?php echo widget('front/category/lists'); ?>
					<!-- 浏览历史 -->
					<?php echo widget('front/BwHistory/historyList'); ?>
					<!-- 最热文章 -->
					<?php echo widget('front/HotArticle/getHotArticle',['num'=>5]); ?>
					<!-- 笑话段子 -->
					<?php echo widget('front/Joke/lists',['page'=>1,'pagesize'=>4]); ?>

				</div>
			</div>
		</div>
	</div>
</div>

	<!--页面尾部-->
	<div class = "footer">PHP内容管理系统　本系统仅供参考和学习</div>
</body>
<script>
	    // $('body').on('click','.top-col',function () {
         //     alert(1);
         //     $(this).addClass( 'curr').siblings().removeClass('curr');
         // });
</script>
</html>
