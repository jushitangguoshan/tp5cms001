<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//店铺
Route::get('v1/shop','api/v1.Shop/shopList');
//分类
Route::get('v1/category/:id','api/v1.Category/categoryList');
//商品
Route::rule('v1/goods/:id','api/v1.Goods/goodsList');
//登录
Route::post('v1/login','api/v1.User/login');
//注册
Route::post('v1/register','api/v1.User/register');
//店铺信息
Route::get('v1/shopInfo/:id','api/v1.Shop/shopInfo');

//获取订单总价
Route::post('v1/getPayPrice','api/v1.Shop/getPayPrice');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
];

