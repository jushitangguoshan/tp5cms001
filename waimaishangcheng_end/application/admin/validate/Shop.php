<?php
/**
 * 管理系统
 * User: gaofengxin(13704659678@163.com)
 * Date: 2019/4/7 0007
 * Time: 下午 4:38
 */

namespace app\admin\validate;


use think\Validate;

class Shop extends Validate
{
    protected $rule = [
        'shop_phone' => "require|max:11|rule:/^1[3-8]\d{9}$/|unique:user",
    ];
    protected $message = [
        'shop_phone.require' => '请输入手机号',
        'shop_phone.max' => '手机号码不能超过11位',
        'shop_phone.rule' => '手机号码格式不正确',

    ];
}