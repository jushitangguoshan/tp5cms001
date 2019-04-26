<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/15 0015
 * Time: 上午 8:59
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