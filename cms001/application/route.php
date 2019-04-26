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



//\think\Route::group('v1/article',function(){
//    \think\Route::get('','api/v1.article/getArticleArr');
//    \think\Route::get(':id','api/v1.article/getArticleInfoById');
//    \think\Route::post('','api/v1.article/addArticle');
//});
\think\Route::get('v1/article/:id','api/v1.article/getArticleInfoById');
\think\Route::get('v1/article','api/v1.article/getArticleArr');


//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//];
