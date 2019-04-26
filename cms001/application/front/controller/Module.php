<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11 0011
 * Time: 下午 6:58
 */
namespace app\front\controller;
use app\common\module\Article;
use app\common\module\Category;
use app\service\BaseController;
use think\Cookie;
class Module extends BaseController
{
    #显示文章内容等信息
    public function show()
    {
        $artId = input('id') ? input('id') : 1;
        //浏览次数自增
        Article::where('id', $artId)->setInc('bw_num');
        #当前文章
        $curr = Article::get($artId);
        #上一篇文章
        $res = Article::where('id', '<', $artId)
                ->where('delete_time')
                ->where('status', '>', 0)
                ->field('id,title')
                ->order('id', 'asc')
                ->limit(1)
                ->find();
        $prev = $res ? $res : 0;
        #下一篇文章
        $res = Article::where('id', '>', $artId)
                ->where('delete_time')
                ->where('status', '>', 0)
                ->field('id,title')
                ->order('id', 'asc')
                ->limit(1)
                ->find();
        $next = $res ? $res : 0;
        $this->assign([
                'prev' => $prev,
                'art' => $curr,
                'next' => $next ]);
        //保存浏览历史
        $this->recordHistory($artId, $curr->title);
        return $this->fetch();
    }
    
    ////记录浏览历史
    private function recordHistory( $id, $title )
    {
        //判断是否有浏览历史
        if( Cookie::has('bwhistory') ){
            $arr = unserialize(Cookie::get('bwhistory'));
            $arr[ $id ] = $title; //var_dump($id,$title,$arr);die;
            if( count($arr) > 5 ){
                //浏览历史超过5条，则移除第一条
                array_shift($arr);
            }
            //去重
            $arr = array_unique($arr);
            //dump($arr);die;
            Cookie::set('bwhistory', serialize($arr), 3600);
        }
        else{
            Cookie::set('bwhistory', serialize([ $id=>$title]), 3600);
        }
    }
    #显示栏目里面的文章
    public function lists()
    {
        $cid = input('cid') ? input('cid') : 1;//没有栏目则选择默认栏目
        //获取当前的栏目文章
        $artArr = Article::where('category_id', $cid)->paginate(3);
        $colName = Category::where('id', $cid)->column('category_name');
        $this->assign([ 'artArr' => $artArr, 'colName' => $colName[ 0 ] ]);
        return $this->fetch('lists');
    }
    
    //路由测试
//    public function getArt( $page = 1, $pagesize = 0 )
//    {
//        if( input('id') ){
//            $artArr = Article::where(function( $query ) use ( $page, $pagesize ){
//                $limit = ( --$page ) * $pagesize.','.$pagesize;
//                $query->where('id', input('id'))
//                    ->field('id,title')
//                    ->limit($limit);
//            })->paginate($pagesize);
//        }
//        else{
//            $artArr = Article::where(function( $query ) use ( $page, $pagesize ){
//                $limit = ( --$page ) * $pagesize.','.$pagesize;
//                $query->field('id,title')
//                    ->limit($limit);
//            })->paginate($pagesize);
//        }
//        return json($artArr);
//    }
}