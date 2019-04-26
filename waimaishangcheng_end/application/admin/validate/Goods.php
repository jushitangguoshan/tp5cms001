<?php
/**
 * 数据的后台验证
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/4 0004
 * Time: 下午 2:48
 */

namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'goods_name' => 'require',
        'price' => 'require|number',
        'storage' => 'require|number'
    ];
    protected $message = [
        'goods_name.require' => '商品名必须',
        'price.require' => '价格必须',
        'price.number' => '价格必须是数字',
        'storage.require' => '数量必须',
        'storage.number' => '数量必须是数字'
    ];
}