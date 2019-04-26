<?php
/**
 * 关于订单的控制器
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/7 0007
 * Time: 下午 7:17
 */

namespace app\front\controller;

use app\common\model\Goods;
use app\common\model\OrderGoods;
use app\common\model\Shop;
use app\front\service\BaseController;
use think\Db;
use Qrcode\QRcode;
use think\Request;
use WxPay\data\WxPayUnifiedOrder;
use WxPay\NativePay;
use WxPay\WxPayConfig;


class Order extends BaseController
{
    /**
     * 显示订单页面
     * @return mixed
     */
    public function order_confirm()
    {
        return view();
    }

    /**
     * 扫码页面
     * @return \think\response\View
     * @throws \think\exception\DbException
     */
    public function pay2()
    {

        $orderId = Request::instance()->get('orderId');
        $orderInfo = \app\common\model\Order::get($orderId)->getData();
        $data['shop_name'] = $orderInfo['shop_name'];
        $data['total_price'] = $orderInfo['total_price'];
        $data['order_id'] = $orderId;
        $data['create_time'] = date('Y-m-d H:i:s',$orderInfo['create_time']);
        $this->assign(['data'=>$data]);


        $orderId = Request::instance()->get('orderId');
        $orderInfo = \app\common\model\Order::get($orderId)->getData();
        //数据处理
        $data['shop_name'] = $orderInfo['shop_name'];
        $data['total_price'] = $orderInfo['total_price'];
        $data['order_id'] = $orderId;
        $data['create_time'] = date('Y-m-d H:i:s',$orderInfo['create_time']);
        $this->assign(['data'=>$data]);

        return view();
    }
    /**
     * 生成二维码
     */
    public function createQrcode()
    {
        $price = (int)Request::instance()->get('p');
        $price = $price*100;
        $orderId = Request::instance()->get('o');
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->SetBody("订饭组外卖");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($price);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("https://www.54daniu.cn/gouda.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($orderId);
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return QRcode::png(urldecode($url2));
    }

    /**
     * 订单增加
     * @return \think\response\Json
     */
    public function addOrder()
    {
        $data = input();
        $orderId = date('Ymd').str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT);
        //插入订单表的数组
        $insertOrder = [
            'order_id'      =>$orderId,
            'shop_id'       =>$data['shopId'],
            'shop_phone'    =>$data['shopPhone'],
            'shop_name'     =>$data['shopName'],
            'user_note'     =>$data['orderRemark'],
            'user_name'     =>$data['name'],
            'user_phone'    =>$data['pn'],
            'address_name'  =>$data['orderAddress'],
            'total_price'   =>$data['price'],
            'status'        =>1,
            'pay_way'       =>$data['paymethod'],
        ];
        //插入订单商品表的数组
        $temp = $data['orderInfo'];
        foreach ( $temp as $k=>$v ) {
            $insertOrderGoods[] = [//插入订单商品表的数组
                'order_id' => $orderId,
                'goods_name' => $v['name'],
                'goods_num' => (int)$v['count'],
                'goods_price' => (int)$v['price'],
            ];
            $updateGoods[] = [//更新商品表的数组
                'id' => (int)$v['goodsId'],
                'storage' => (int)$v['count'],
            ];
        }

        Db::startTrans();
        try{
            //新增订单数据
            $order = new \app\common\model\Order($insertOrder);
            if( ! $order->save() ){

                throw new \Exception();
            }
            //新增订单商品表数据
            $orderGoods = new OrderGoods();
            if( ! $orderGoods->saveAll($insertOrderGoods) ){
                throw new \Exception();
            }

            //修改该商品库存
            $goods = new Goods();
            //dump($updateGoods);
            foreach ($updateGoods as $k => $v){
                $kc = $goods->where('id',$v['id'])->field('storage')->find()->getData();
                $temp = $kc['storage']-$v['storage'];
                $res = $goods->isUpdate(true)->save( ['id' => $v['id'], 'storage' =>$temp] );
//                if( !$res ){
//                    throw new \Exception();
//                }
            }
            //修改该商品库存
//            $goods = new Goods();
//            //dump($updateGoods);die;
//            if( ! $goods->saveAll($updateGoods) ){
//                throw new \Exception();
//            }
            Db::commit();


            // 指明给谁推送，为空表示向所有在线用户推送
            $to_uid = "123";
// 推送的url地址，使用自己的服务器地址
            $push_api_url = "http://www.takeout.com:2121/";
            $post_data = array(
                "type" => "publish",
                "content" => "这个是推送的测试数据",
                "to" => $to_uid,
            );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));
            $return = curl_exec ( $ch );
            curl_close ( $ch );






            return json(['code'=>100,'msg'=>"下单成功",'order_id'=>$orderId]);
        }catch( \Exception $e){
            Db::rollback();
            return json(['code'=>401,'msg'=>"下单失败"]);
        }
    }
}