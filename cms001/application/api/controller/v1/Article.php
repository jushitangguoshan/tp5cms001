<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/14 0014
 * Time: 下午 3:02
 */

namespace app\api\controller\v1;

use app\admin\controller\Module;
use think\Controller;
use think\Request;

class Article extends Controller
{
    public function getArticleArr()
    {
        $page = Request::instance()->get('page');
        $pagesize = Request::instance()->get('pagesize');
        if( !preg_match('/^[0-9]+$/',$page)  || !preg_match('/^[0-9]+$/',$pagesize)){
            return json([ 'code' => 400, 'message' => '页码、页数必须为整数' ]);
        }
        $artArr = \app\common\module\Article::where('status', 1)->field('id,title')->page($page)->paginate($pagesize);
        if( !$artArr ){
            return json([ 'code' => 500, 'message' => '获取数据失败' ]);
        }
        else if( empty($artArr) ){
            return json([ 'code' => 600, 'message' => '数据为空' ]);
        }
        return json($artArr);
    }
    
    public function getArticleInfoById()
    {
        if( !is_int(input('id')) ){
            return json([ 'code' => 400, 'message' => 'id必须为整数' ]);
        }
        $art = \app\common\module\Article::all(function( $query ){
            $query->where('id', input('id'))
            ->field('id,title');
        });
        if( !$art ){
            return json([ 'code' => 500, 'message' => '获取数据失败' ]);
        }
        else if( empty($art) ){
            return json([ 'code' => 600, 'message' => '数据为空' ]);
        }
        return json($art);
    }
    
    public function addArticle()
    {
        $post = input();
        if( !empty($post) ){
            return ( new Module() )->addArticleHandle();
        }
    }
}