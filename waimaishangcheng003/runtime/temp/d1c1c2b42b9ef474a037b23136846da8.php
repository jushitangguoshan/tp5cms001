<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"E:\takeout.com\public/../application/admin\view\order\order_handle_list.html";i:1554775455;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="/static/admin/css/reset.css">
    <link rel="stylesheet" href="/static/admin/css/bootstrap-admin.css">
    <link rel="stylesheet" href="/static/admin/css/backstage.css">
    <link rel=stylesheet   href="/static/admin/css/order.css">
</head>
<body>
<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orderInfo): $mod = ($k % 2 );++$k;?>
<div class="details">
    <div class="details_operation clearfix">
        <div class="fl">  </div>
        <div class="fr"><span id="tip"></span></div>
    </div>
    <div class="order-content-wrap">
        <div class="order-content">
            <div class="order-meal">
                <table>
                    <thead>
                        <tr>
                            <th colspan="3">
                                <a href="#" class="shop-name"><?php echo $orderInfo['address_name']; ?></a>
                                <p class="shop-info">
                                    <span class="phone-icon"></span>
                                    商家电话：<?php echo $orderInfo['shop_phone']; ?>
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($orderInfo['goodsArr']) || $orderInfo['goodsArr'] instanceof \think\Collection || $orderInfo['goodsArr'] instanceof \think\Paginator): $i = 0; $__LIST__ = $orderInfo['goodsArr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsInfo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $goodsInfo['goods_name']; ?></td>
                        <td><?php echo $goodsInfo['goods_num']; ?></td>
                        <td class="text-right">￥<?php echo $goodsInfo['goods_price']; ?></td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>

                </table>
                <div class="order-price">
                    总价：<span class="ft-red">￥<?php echo $orderInfo['total_price']; ?></span>
                </div>
                <div class="order-delivery">
                    <div class="receive-info">
                        订单编号：<?php echo $orderInfo['order_id']; ?><br>
                        送餐地址：<?php echo $orderInfo['address_name']; ?><br>
                        联系人：<?php echo $orderInfo['user_name']; ?><br>
                        电话：<?php echo $orderInfo['user_phone']; ?><br>
                        送达时间：<?php echo $orderInfo['create_time']; ?>  <br>
                        备注信息：<?php echo $orderInfo['user_note']; ?>
                    </div>
                </div>
            </div>
            <div class="order-info">
                <div class="delivery-info">
                    <div class="delivery-card ">
                        <div class="card-header nick-selected">
                            <div class="round">
                            </div>
                            <div class="line-through ">
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="status-msg">订单提交成功 </div>
                            <div class="prompt">订单号：<?php echo $orderInfo['order_id']; ?></div>
                            <div class="time"><?php echo $orderInfo['create_time']; ?> </div>
                        </div>
                    </div>
                    <div class="delivery-card ">
                        <div class="card-header nick-selected">
                            <div class="round"></div>
                        </div>
                        <div class="card-body ">
                            <div class="status-msg"> 已提交订单</div>
                            <div class="prompt">等待商家接单(餐到付款)</div>
                            <div class="time"></div>
                        </div>
                    </div>
                    <div class='delivery-card n'>
                        <div class="card-header nick-selected">
                            <div class="round "></div>
                        </div>
                        <div class="card-body ">
                            <div class="status-msg"></div>
                            <div class="prompt"> </div>
                            <div class="time"></div>
                        </div>
                    </div>
                    <div class="order-operator " >
                        <div class="operator-btns">
                            <a class=pay-btn onclick=takeOrder(<?php echo $orderInfo['order_id']; ?>)>接单</a>
                            <a class=pay-btn onclick=cancelOrder(<?php echo $orderInfo['order_id']; ?>)>拒绝</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<!--提示框-->
<div class="modal fade" id="mymodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="btn-close" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 id="alert-title" class="modal-title">标题</h4>
            </div>
            <div class="modal-body">
                <p id="alert-body">内容</p>
            </div>
            <div class="modal-footer">
                <button id="btn-ok" type="button" class="btn btn-default" data-dismiss="modal">知道了</button>
            </div>
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery-1.8.3.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<script src="/static/admin/js/common.js"></script>
<script src="/static/admin/js/jquery.jqprint-0.3.js"></script>
<script>
    $(document).ready(function () {
        var hasNewOrder="1";
        if(hasNewOrder!=1){
            startRequest();
        }
        //轮询器
        setInterval("startRequest()",2000);
    });
    function startRequest(){
        $.ajax({
            url:'<?php echo url('admin/order/orderHandleList'); ?>',
            async:true,
            timeout:3000,
            success:function(){
                window.location.reload()  //刷新页面
            },
            error:function(){
                startRequest();
            }
     });

    }
    //接单
    function takeOrder(orderId){
        $.ajax({
            url:'<?php echo url('admin/order/takeOrder'); ?>',
            type:'post',
            data:{order_id:orderId},
            success:function (res) {
                alert(res.msg);
            }

        })
    }
    // /拒单
    function cancelOrder(orderId){
        $.ajax({
            url:'<?php echo url('admin/order/cancelOrder'); ?>',
            type:'post',
            data:{order_id:orderId},
            success:function (res) {
                alert(res.msg);
            }

        })
    }






    /*接单
      $(".order-delivery").jqprint();
        alert("接单"+"\n"+orderId);
        var postUrl="/admin/ajax/operateOrder.php";
        $.post(postUrl, {
            type:"take",
                id:id
            },
            function(data,status,xhr) {
                if(status=="success"){
                    $res= $.parseJSON(data);
                    if($res.code=="0"){
                        //  showAlert("提示","接单成功","/admin/moniterOrder.php");
                    } else{
                        showAlert("提示",$res.msg,"/admin/moniterOrder.php");
                    }
                }else{
                    showAlert("提示","服务器异常");
                }
            });
    */

    /* 拒单
    alert("拒单");
        var postUrl="/admin/ajax/operateOrder.php";
        $.post(postUrl,
            {type:"cancel",
                id:id},
            function(data,status,xhr) {
                if(status=="success"){
                    $res= $.parseJSON(data);
                    if($res.code=="0"){
                        showAlert("提示","已拒绝","/admin/moniterOrder.php");
                    } else{
                        showAlert("提示",$res.msg,"/admin/moniterOrder.php");
                    }
                }else{
                    showAlert("提示","服务器异常");
                }
            });
    */
</script>
</body>
</html>