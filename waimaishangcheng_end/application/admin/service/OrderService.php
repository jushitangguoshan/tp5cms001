<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/7 0007 / 下午 4:33
 */
namespace app\admin\service;
use app\common\model\Order;
use think\Request;
use think\Session;

class OrderService extends BaseController
{
    #订单状态
    protected static $orderStatus=[
        '1'=>"已下单",
        '2'=>'已接单',
        '3'=>'下单未支付',
        '4'=>'已支付未发货',
        '5'=>'已发货未接收',
        '6'=>'已接收',
        '7'=>'订单完成'
    ];
    #支付状态
    protected static $payStatus=[
        '0'=>"支付宝",
        '1'=>'微信',
        '2'=>'银联',
    ];

    /**
     * 超级管理员查询订单
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getOrderArrBySuperAdmin()
    {
        $page = Request::instance()->get('page');
        $limit = Request::instance()->get('limit');
        $orderArr = Order::where('status','>',0)->page($page,$limit)->select();
        return self::historyOrderArrHandle(self::getDataArr($orderArr));
    }

    /**
     * 当前店铺待处理的订单
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getOrderArrByShopAdmin()
    {
        $page = Request::instance()->get('page');
        $limit = Request::instance()->get('limit');
        //判断登录的后台管理员的id
        $adminId = Session::get('adminId');
        //通过店铺客服id --》获取 当前用户的 店铺id
        $admin =  \app\common\model\Admin::find($adminId);
        $shopId =$admin->getStoreInfo->id;
        //通过店铺管理员id --》获取当前店铺订单
        $orderArr = Order::where('shop_id',$shopId)
            ->where('status',1)
            ->page($page,$limit)
            ->select();
       // dump($orderArr);die;
        return self::getDataArr($orderArr,$admin);
    }

    /**
     * 数据处理
     * @param $orderArr
     * @param string $admin
     * @return array
     * @throws \think\exception\DbException
     */
    private static function getDataArr($orderArr,$admin=false)
    {
        //dump($orderArr);die;
        $orderInfoArr = [];
        foreach ($orderArr as $key=>$value){
            ////获取当前用户的店铺id
            if( $admin !== false ){
               $orderInfoArr[$key]['shop_phone'] = $admin->getStoreInfo->shop_phone;
            }
            $orderInfoArr[$key]['order_id'] = $value->order_id;
            $orderInfoArr[$key]['user_name'] = $value->user_name;
            $orderInfoArr[$key]['user_phone'] = $value->user_phone;
            $orderInfoArr[$key]['total_price'] = $value->total_price;
            $orderInfoArr[$key]['pay_way_id'] = $value->pay_way;
            $orderInfoArr[$key]['pay_way_name'] = self::$payStatus[$value->pay_way];
            $orderInfoArr[$key]['order_status'] = $value->status;
            $orderInfoArr[$key]['order_status_name'] = self::$orderStatus[$value->status];
            $order = Order::get($value->order_id);
            $temp = $order->getGoodsInfoByOrderId;
            $tempArr=[];
            foreach ( $temp as $k=>$v){
                $tempArr[$k]['goods_name'] = $v->goods_name;
                $tempArr[$k]['goods_num'] = $v->goods_num;
                $tempArr[$k]['goods_price'] = $v->goods_price;
            }
            $orderInfoArr[$key]['goodsArr'] = $tempArr;
            $orderInfoArr[$key]['shop_name'] = $value->shop_name;
            $orderInfoArr[$key]['address_name'] = $value->address_name;
            $orderInfoArr[$key]['user_note'] = $value->user_note;
            $orderInfoArr[$key]['create_time'] = $value->create_time;
        }
        //dump($orderInfoArr);die;
        return $orderInfoArr;
    }
    /**
     * 普通店铺--》获取历史订单数组
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getHistoryOrderArrByAdmin()
    {
        //判断登录的后台管理员的id
        $adminId = Session::get('adminId');
        //通过店铺客服id --》获取 当前用户的 店铺id
        $admin =  \app\common\model\Admin::find($adminId);
        $shopId =$admin->getStoreInfo->id;
        //通过店铺管理员id --》获取当前店铺订单
        $orderArr = Order::where('shop_id',$shopId)
            ->where('status','>',1)
            ->select();
        return self::historyOrderArrHandle(self::getDataArr($orderArr,$admin));
    }

    /**
     * 超级管理员查看所有历史订单
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getHistoryOrderArrBySuperAdmin()
    {
        $orderArr = Order::where('status','>',1)->select();
        return self::historyOrderArrHandle(self::getDataArr($orderArr));
    }
    /**
     * 历史订单数组处理
     * @param $res
     */
    private static function historyOrderArrHandle($res)
    {
        foreach ( $res as $key => $v){
            $arr2 = array_map('array_shift',$v['goodsArr']);
            $res[$key]['name'] = '';
            $res[$key]['is_status'] = '';
            if ( $res[$key]['order_status'] <= 3 ){
                $res[$key]['is_status'] = '未支付';
            }else {
                $res[$key]['is_status'] = '已支付';
            }
            foreach ( $arr2 as $value ){
                $res[$key]['name'] .= $value.'+';
            }
            $res[$key]['name'] = substr($res[$key]['name'],0,strlen($res[$key]['name'])-1);
        }
        return $res;
    }

}