<?php
/**
 * 前台首页控制器
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/6 0006
 * Time: 上午 9:02
 */

namespace app\front\controller;
use app\front\service\BaseController;
use think\Db;

class Home extends BaseController
{
    /**
     * 显示前台页面
     * @return mixed
     */
    public function index()
    {
        $url = 'http://www.takeout.com/v1/shop/';
        $list = $this->https_request($url);
        $res = Db::name('title_address')->order('id asc')->select();
        return $this->fetch('index',['list'=>$list['data'],'data' => $res]);

    }

}