<?php
/**
 * 所有店铺api
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/4 0004
 * Time: 下午 9:40
 */

namespace app\api\controller\v1;


use think\Controller;
use think\Request;

class Shop extends Controller
{
    /**
     * 获取所有营业中的店铺信息API
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function shopList()
    {
        $shopModel = new \app\common\model\Shop();
        $data = $shopModel
            ->where('status',1)
            ->select();
        if(!$data){
            return json(['errcode'=>500,'msg'=>'系统内部错误']);
        }
        $list = [];
        foreach($data as $key => $obj){
            array_push($list,[
                'id' => $obj->id,
                'name' => $obj->name,
                'user_id' => $obj->user_id,
                'building' => $obj->building,
                'address_id'=> $obj->address_id
            ]);
        }
        return json(['errcode'=>0,'data'=>$list]);
    }

    /**
     * 获取商铺信息通过商铺id
     * @param $id
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function shopInfo($id)
    {
        $data = \app\common\model\Shop::get($id)->getData();
        $list['shopId'] = $data['id'];
        $list['shopName'] = $data['name'];
        $list['shopPhone'] = $data['shop_phone'];
        $list['building'] = $data['building'];
        $list['shopFloor'] = $data['floor'];
        $list['shopIcon'] = $data['image'];
        $list['shopTip'] = $data['notice'];
//        foreach($data as $key => $obj){
//            $list['shopId'] = $obj->id;
//            $list['shopName'] = $obj->name;
//            $list['shopPhone'] = $obj->shop_phone;
//            $list['building'] = $obj->building;
//            $list['shopFloor'] = $obj->floor;
//            $list['shopIcon'] = $obj->image;
//            $list['shopTip'] = $obj->notice;
//
//        }
        return json(['errcode'=>0,'data'=>$list]);
    }

    /**
     * 获取订单总价
     */
    public function getPayPrice()
    {
        if(Request::instance()->isAjax() && Request::instance()->isPost()){
            $arr = input()['itemsTxt'];
            $price = $this->multi_array_sum($arr, 'price');
            return json(['code'=>0,'price'=>$price]);
        }
    }

    private function multi_array_sum($arr,  $key)
    {
        if ($arr)
        {
            $sum_no = 0;

            foreach($arr as $v)
            {
                $sum_no +=  $v[$key];
            }
            return $sum_no;
        } else {
            return 0;
        }
    }
}