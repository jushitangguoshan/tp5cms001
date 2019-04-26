<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\thinkphp5\mytest\public/../application/admin\view\module\cp_article.html";i:1552572251;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台</title>
	<link rel="stylesheet" href="/static/admin/css/dashicons.css">
	<link rel="stylesheet" href="/static/admin/css/style.css">
	<script src="/static/admin/js/jquery.js"></script>

</head>
<body>
<div class="wrap wrap-article">
	<h1>文章管理</h1>
	<div class="s-nav">
		<div>
			<form method="post" action="">
			<select name="screening_category">
				<option value="0"> 栏目筛选 </option>
				<?php echo widget('admin/category/colList'); ?>
			</select>
			<input type="submit" value="筛选">
			</form>
		</div>
		<div>
			<form method="post" action="">
			<select name="screening_order">
				<option value="time-desc"  >时间降序</option>
				<option value="time-asc"  >时间升序</option>
				<option value="show-desc"  >发布状态</option>
			</select>
			<input type="submit" value="排序">
			</form>
		</div>
		<div>
			<form method="post" action="">
				<input type="text" name="keyword_search" value="" placeholder="输入关键字">
				<input type="submit" value="搜索文章">
			</form>
		</div>
	</div>
	<div class="tips"></div>
	<div class="box">
		<div class="box-body">
			<table>
				<tr><th width="80">状态</th><th>文章标题</th><th width="120">所属栏目</th><th width="100">作者</th><th width="150">创建时间</th><th width="100">操作</th></tr>
				<?php foreach($list as $art): ?>
				<tr>
                         <?php if($art['status'] == '1'): ?>
					<td class="s-show"><i class="icon-yes">已发布</i></td>
                         <?php else: ?>
                         <td class="s-show"><i class="icon-wait">草稿</i></td>
                         <?php endif; ?>
					<td class="s-title"><a href="<?php echo url('front/module/show',['id'=>$art['id']]); ?>" target="_blank"><?php echo $art['title']; ?></a></td>
					<td><a href="?cid=6"><?php echo $art['category']['category_name']; ?></a></td>
					<td><?php echo $art['author']['username']; ?></td>
					<td><?php echo $art['create_time']; ?></td>
					<td class="s-act">
						<a href="<?php echo url('module/cp_article_edit_2',['id'=>$art['id']]); ?>">编辑</a>
						<a href="<?php echo url('module/delArticle',['id'=>$art['id']]); ?>" class="jq-del">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
     <div class="pagelist">
          <?php echo $list->render(); ?>
     </div>

</div>
<script>
    (function () {
	   //删除前提示
	   $(".jq-del").click(function () {
		  return confirm("您确定要删除此文章？");
	   });
    })();
</script>
</body>
</html>