<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 2:07
     */
    namespace app\admin\controller;
    use app\service\BaseController;
    use think\module\Controller;
    use think\Session;

    class Home extends BaseController
    {
        public function login()
        {
            if(Session::get('user')){
                Session::delete('user');
            }
            return $this->fetch();
        }
    }