<?php
/**
 * 获取商品api
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/4 0004
 * Time: 下午 3:52
 */

namespace app\api\controller\v1;


use think\Controller;

class Goods extends Controller
{
    public function goodsList()
    {
        $goodsModel = new \app\common\model\Goods();
        $belong_category_id = input('id');
        $data = $goodsModel
            ->where('belong_category_id',$belong_category_id)
            ->where('storage','>','0')
            ->select();
        if(!$data){
            return json(['errcode'=>500,'msg'=>'系统内部错误']);
        }
        $list = [];
        foreach ($data as $obj){
            array_push($list,[
                'id' => $obj->id,
                'price' => $obj->price,
                'goods_name' => $obj->goods_name,
                'image' => $obj->image,
                'create_host' => $obj->create_host
            ]);
        }
        return json(['errcode'=>0,'data'=>$list]);
    }
}