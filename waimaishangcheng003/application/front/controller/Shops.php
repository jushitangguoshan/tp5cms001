<?php
/**
 * Created by PhpStorm.
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/6 0006
 * Time: 下午 2:54
 */

namespace app\front\controller;
header("Access-Control-Allow-Origin: *");


use app\common\model\Shop;
use app\front\service\BaseController;
use think\Db;


class Shops extends BaseController
{
    public function shop()
    {
        //创建者id
        $id = input('id');
        $categoryUrl = "http://www.takeout.com/v1/category/$id";
        $categoryList = $this->https_request($categoryUrl);
        $shopInfo = DB::name('shop')->where('user_id',$id)->find();
        return $this->fetch('shop',['list'=>$categoryList['data'],'shopInfo'=>$shopInfo]);
    }
}