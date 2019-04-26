<?php
/**
 * 菜品分类api
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/4 0004
 * Time: 下午 9:32
 */

namespace app\api\controller\v1;


use think\Controller;

class Category extends Controller
{
    public function categoryList()
    {
        //获取创建者id
        $masterId = input('id');
        $categoryModel = new \app\common\model\Category();
        $data = $categoryModel
            ->where('masterId',$masterId)
            ->order('weight','desc')
            ->where('status',1)
            ->select();
        $list = [];
        foreach ($data as $obj){
            array_push($list,[
                'id' => $obj->id,
                'masterId' => $obj->masterId,
                'category_name' => $obj->category_name,
                'weight' => $obj->weight
            ]);
        }
        return json(['errcode'=>0,'data'=>$list]);
    }
}