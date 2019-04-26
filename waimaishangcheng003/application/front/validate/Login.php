<?php
/**
 * Created by PhpStorm.
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/8 0008
 * Time: 下午 9:45
 */

namespace app\front\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'phone' => 'require|number',
        'pwd' => 'require'
    ];
    protected $message = [
        'phone.require' => '用户名必须',
        'pwd.require' => '密码必须',
        'phone.number' => '价格必须是数字'
    ];
}