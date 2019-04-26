<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/2 0002
     * Time: 下午 8:46
     */

    namespace app\admin\dateValidate;
    use think\Validate;

    class LoginData extends Validate
    {
        protected $rule=[
            ['username','require|min:1|max:20|token',"用户名不能为空|用户名至少一位|用户名最多7位"],
            ['password','require|min:2|max:32',"密码不能为空|密码最少为3位|密码最多16位"],
        ];
    }