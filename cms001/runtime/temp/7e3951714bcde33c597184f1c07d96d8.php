<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\thinkphp5\mytest\public/../application/front\view\module\show.html";i:1552549281;s:54:"D:\thinkphp5\mytest\application\front\view\layout.html";i:1552485071;}*/ ?>
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
<div class = "main">
	<!-- 幻灯片模块 -->
	<!-- 文章列表模块 -->
	<div class = "main-body">
		<div class = "main-wrap">
			<div class = "main-left">
				<div class = "as">
					<div class = "as-title"><h1><?php echo $art['title']; ?></h1></div>
					<div class = "as-row">
						<span>栏目：<a href = "list.php?cid=<?php echo $art['category']['id']; ?>"><?php echo $art['category']['category_name']; ?></a></span>
						<span>作者：<?php echo $art['author']['username']; ?></span>
						<span>发表时间：<?php echo date("Y-m-d H:i:s",strtotime($art['create_time'])); ?></span><span>阅读：<?php echo $art['bw_num']; ?></span>
					</div>
					<div class = "as-content">
						<p>欢迎使用 PHP内容管理系统！</p>
						<p><?php echo $art['artInfo']['content']; ?></p>
					</div>
					<div class = "as-change">
						<span>上一篇：<?php if($prev == '0'): ?>无<?php else: ?>
							<a href = "<?php echo url('module/show',['id'=>$prev['id']]); ?>" title = "<?php echo $prev['title']; ?>"><?php echo $prev['title']; ?></a>
							<?php endif; ?>
						</span>
						<span>下一篇：<?php if($next == '0'): ?>无<?php else: ?>
							<a href = "<?php echo url('module/show',['id'=>$next['id']]); ?>" title = "<?php echo $next['title']; ?>"><?php echo $next['title']; ?></a>
							<?php endif; ?>
						</span>
					</div>
				</div>
			</div>
			<div class = "main-right">
				<div class = "si">
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
