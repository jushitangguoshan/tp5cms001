<?php
/**
 * 管理系统
 * User: gaofengxin(13704659678@163.com)
 * Date: 2019/4/8 0008
 * Time: 下午 4:48
 */

namespace app\admin\controller;


use app\admin\service\BaseController;
use app\admin\service\OrderService;
use think\Request;

class Orderinquiry extends BaseController
{
    //1-已下单 、2-已接单、3-下单未支付、4-已支付未发货、5-已发货未接收、6-已接收
    public function index()
    {
        return $this->fetch();
    }
    public function index_list()
    {
        $res = OrderService::getOrderArrBySuperAdmin();
        $count = count($res);
        return json(['data'=>$res,'msg'=>'','count'=>$count,'code'=>0]);
    }
}