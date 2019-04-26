<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/7 0007 / 下午 3:24
 */

namespace app\common\model;


use think\Model;

class Order extends Model
{
    protected $creatTime = 'create_time';
    /**
     * 订单与商品之间的关系
     * @return \think\model\relation\HasMany
     */
    public function getGoodsInfoByOrderId()
    {
        return $this->hasMany('OrderGoods','order_id','order_id');
    }
}