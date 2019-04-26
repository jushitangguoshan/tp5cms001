<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12 0012
 * Time: 下午 3:10
 */

namespace app\front\widget;

use app\common\module\Article;
use app\service\BaseController;

class HotArticle extends BaseController
{
    public function getHotArticle( $num = 10, $keyword = '' )
    {
        //判断是否有id ---[没有]则查询所有文章进行浏览次数排序  or    [有]则找当前栏目文章进行浏览次数排序
        $cid = input('cid') ? input('cid') : 0;
        //存在栏目id--->获取该栏目下文章-->通过浏览次数排序(只包含已经发布的文章)
        if ( $cid !== 0 ) {
            $artArr = Article::all(function( $query ) use ( $num, $cid ) {
                $query->where('category_id', $cid)
                ->where('status', 1)
                ->where('delete_time')
                ->field('id,title')
                ->order('bw_num', 'desc')
                ->limit($num);
            });
            
        } else { //不存在栏目id--->获取所有栏目下所有文章-->通过浏览次数排序(只包含已经发布的文章)
            $artArr = Article::all(function( $query ) use ( $num ) {
                $query->where('status', 1)
                ->where('delete_time')
                ->field('id,title')
                ->order('bw_num', 'desc')
                ->limit($num);
            });
        }
        $html = <<<HOT
               <div class="si-each">
                    <div class="si-title"><span class="si-p3-top">TOP 10</span> 热门文章</div>
                    <div class="si-p3">
                        %s
                    </div>
                </div>
HOT;
        $content = '';
        foreach ( $artArr as $k => $value ) {
            $url = url('module/show', [ 'id' => $value['id'] ]);
            $content .= "<p><a href='" . $url . "'>$value[title]</a></p>";
        }
        return sprintf($html, $content);
    }

}