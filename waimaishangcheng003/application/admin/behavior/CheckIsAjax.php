<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/3 0003 / 上午 9:47
 */

namespace app\admin\behavior;


use think\Request;
use traits\controller\Jump;

class CheckIsAjax
{
    use Jump;
    public function run()
    {
        if( !Request::instance()->isAjax() ){
            $this->error("请求失败");
        }
    }
}