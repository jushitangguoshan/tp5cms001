<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/7 0007 / 下午 3:20
 */

namespace app\common\model;


use think\Model;

class OrderGoods extends Model
{
    protected $createTime = 'create_time';

    public function order()
    {
        return $this->belongsTo('Order','order_id','order_id');
    }
}