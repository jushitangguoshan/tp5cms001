<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\takeout.com\public/../application/admin\view\categorys\category_list.html";i:1554715329;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.1</title>
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/cookie.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
    <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite>
        </a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()">
            <i class="layui-icon"></i>批量删除
        </button>
        <span class="x-right" style="line-height:40px">共有数据：<?php echo count($categoryList); ?>条</span>
    </xblock>

    <table class="layui-table layui-form" >
        <thead>
        <tr>
            <th width="20">
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary">
                    <i class="layui-icon">&#xe605;</i>
                </div>
            </th>
            <th width="70">ID</th>
            <th width="200">栏目名</th>
            <th width="50">顺序</th>
            <th width="70">状态</th>
            <th width="100">创建时间</th>
            <th width="200">操作</th>
        </thead>
        <tbody class="x-cate">
            <?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                <tr cate-id=<?php echo $cate['id']; ?>>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i>
                        </div>
                    </td>
                    <td><?php echo $cate['id']; ?></td>
                    <td>
                        <?php echo $cate['category_name']; ?>
                    </td>
                    <td><p><?php echo $cate['weight']; ?></p></td>
                    <td>
                        <?php if($cate['status'] == 1): ?>
                            <input type="checkbox" name="switch" lay-text="开启|停用" checked  lay-filter="switchtest" lay-skin="switch">
                        <?php else: ?>
                            <input type="checkbox" name="switch" lay-text="开启|停用"  lay-filter="switchtest" lay-skin="switch">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $cate['create_time']; ?>
                    </td>
                    <td class="td-manage">
                        <button class="layui-btn layui-btn layui-btn-xs" onclick="category_edit(this,<?php echo $cate['id']; ?>)">
                            <i class="layui-icon">&#xe642;</i>编辑
                        </button>
                        <button class="layui-btn-danger layui-btn layui-btn-xs" onclick="member_del(this,<?php echo $cate['id']; ?>)" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>删除
                        </button>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<script>
    layui.use(['layer','table','form'],function () {
        var form = layui.form,
            layer = layui.layer,
               $ = layui.jquery;
        //更新状态
        form.on('switch(switchtest)', function(data){
            //是否被选中，true或者false
            var status = data.elem.checked ? 1 : 0;
            var tr = $(data.elem).parents('tr');
            var categoryId =  tr[0]['attributes']['cate-id']['value'];
            $.ajax({
                url:"<?php echo url('admin/categorys/updateCategoryStatus'); ?>",
                type:'post',
                data:{id:categoryId,status:status},
                dataType: "json",
                success :function(res){
                    if( res.code===100 ){
                        layer.msg(res.msg, {icon: 1, time: 1000});
                    }else{
                        layer.msg(res.msg, {icon: 1, time: 5});
                    }
                },
                error:function () {
                    layer.alert("操作失败！！！",{icon:5});
                }
            });
            return false;
        });
    });
    ///弹层
    function category_edit(opj,id) {
        //页面层
        var index = layer.open({
                    type: 2,
                    area: ['60%','70%' ], //宽高
                    title : '编辑栏目',
                    shadeClose:true,//点击遮罩关闭
                    scrollbar: false,//关闭滑条
                    fixed:true,
                    content: "<?php echo url('admin/categorys/category_edit'); ?>?id="+id,
                    btn:["关闭"],
                    yes:function () {
                        parent.location.reload(); // 父页面刷新
                    }
                });
    }
    /*用户-删除*/
    function member_del(obj,id) {
        layer.confirm('确认要删除吗？', function () {
            //发异步删除数据
            $.ajax({
               url:"<?php echo url('admin/categorys/category_del'); ?>",
               type:'post',
               data:{id,id},
               dataType:'json',
               success:function(res){
                   if( res.code===100 ){
                       $(obj).parents("tr").remove();
                       layer.msg('已删除!', {icon: 1, time: 1000});
                   }else{
                       layui.msg(res.msg, {icon: 1, time: 5});
                   }
               },
               error:function () {
                    layer.alert("删除失败！！！",{icon:5});
               }
            });

        });
    }
    //批量删除
    function delAll(argument) {
        var data = tableCheck.getData();
            layer.confirm('确认要删除吗？' + data, function (index) {
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || [];
(function () {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();</script>
</body>

</html>