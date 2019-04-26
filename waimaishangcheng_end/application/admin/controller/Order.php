<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 2:23
 */

namespace app\admin\controller;


use app\admin\service\BaseController;
use app\admin\service\OrderService;

use think\Request;
use think\Session;

class Order extends BaseController
{
    /**
     * 待处理订单
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function orderHistoryList()
    {
        return view();
    }
    /**
     * 获取订单列表
     * @return \think\response\View
     */
    public function orderHandleList()
    {
        //获取订单详情表数组
        $orderInfoArr = OrderService::getOrderArrByShopAdmin();
        //dump($orderInfoArr);die;
        $this->assign(['data'=>$orderInfoArr]);
        return view();
    }

    /**
     * 获取历史订单列表
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     *
     */
    public function historyOrderList()
    {

        if( Session::get('roleId') == 1 ){
            $orderInfoArr = OrderService::getHistoryOrderArrBySuperAdmin();
        }else{
            $orderInfoArr = OrderService::getHistoryOrderArrByAdmin();
        }
        $count = count($orderInfoArr);
        return json(['data'=>$orderInfoArr,'msg'=>'','count'=>$count,'code'=>0]);
    }
    /**
     * 商家接单
     */
    public function takeOrder()
    {
        if(Request::instance()->isAjax() && Request::instance()->isPost()){
            $data['order_id'] = Request::instance()->post('order_id');
            $data['status'] = 2;
            $data['take_time'] = time();
            $res = \app\common\model\Order::update( $data );
            if($res){
                return json(['code'=>100,'msg'=>'接单成功']);
            }
        }
        return json(['code'=>0,'msg'=>'接单失败']);
    }

    /**
     * 商家拒单
     */
    public function cancelOrder()
    {
        if(Request::instance()->isAjax() && Request::instance()->isPost()){
            $data['order_id'] = Request::instance()->post('order_id');
            $data['status'] = 10;
            $data['delete_time'] = time();
            $res = \app\common\model\Order::update( $data );
            if($res){
                return json(['code'=>100,'msg'=>'拒单成功']);
            }
        }
        return json(['code'=>0,'msg'=>'拒单失败']);
    }
}