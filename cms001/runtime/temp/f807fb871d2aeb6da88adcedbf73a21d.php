<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"D:\thinkphp5\mytest\public/../application/admin\view\module\cp_article_edit.html";i:1552359193;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台</title>
	<link rel="stylesheet" href="/static/admin/css/style.css">
	<script src="/static/admin/js/ckeditor/ckeditor.js"></script>
	<script src="/static/admin/js/jquery.js"></script>
</head>
<body>
<div class="wrap wrap-article-edit">
	<h1>文章管理</h1>
	<div class="tips"></div>
	<div class="box">
		<div class="box-title">添加/编辑文章</div>
		<div class="box-body">
			<form method="post" action="" onsubmit="return false;" enctype="multipart/form-data">
				<table>
					<tr><th width="80">标题：</th><td>
						<input type="text" name="title" value="">
					</td></tr>
					<tr><th>栏目：</th><td>
						<select name="category_id">
							<option value="0">选择栏目</option>
							<?php echo widget('admin/category/colList'); ?>
						</select></td>
					</tr>
					<tr class="s-keywords"><th>关键字：</th><td>
						<input type="text" name="keyword" value=""><span>多个关键字 请用英文逗号（,）分开</span>
					</td></tr>
					<tr class="s-description"><th>内容提要：</th><td>
						<textarea name="description"></textarea><span>（内容提要请在 200 个字以内）</span>
					</td></tr>
					<tr class="s-thumb"><th>封面图片：</th><td>
						<input type="file" name="thumb"><span>（超过 780*220 图片将被缩小）</span>
					</td></tr>
					<tr class="s-editor"><th>编辑内容：</th><td>
						<textarea name="content"></textarea>
					</td></tr>
					<tr class="s-act"><th></th><td>
						<input type="submit" name ='add' value="立即发布">
						<input type="submit" name="save" value="保存草稿" >
					</td></tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script src="./js/article.config.js"></script>
<script>
    $(function(){
	   $(':submit').click(function(){
		  var content = CKEDITOR.instances.content.getData();
		  var format=new FormData(document.querySelector("form"));
		  format.append('opeate',$(this).val());
		  format.append("content",content);
		  $.ajax({
			 url:"<?php echo url('admin/module/addArticleHandle'); ?>",
			 type:'post',
			 data:format,
			 dataType:'json',
			 contentType: false,
			 processData: false,
			 success:function(res){
				console.log(res);
				alert(res.msg);
			 }
		  })
	   });
    })
</script>
<script>
    CKEDITOR.config.height = 400;
    CKEDITOR.config.width = "100%";
    CKEDITOR.replace("content");
</script>

</body>
</html>