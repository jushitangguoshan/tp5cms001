<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/12 0012
     * Time: 上午 11:15
     */

    namespace app\admin\behavior;
    use think\Session;
    use traits\controller\Jump;

    class CheckLogin
    {
        use Jump;
        public function run()
        {
            if(!Session::get('user')){
                $this->error("请先登录",'admin/home/login');
            }
        }
    }