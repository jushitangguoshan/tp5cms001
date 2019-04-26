<?php
/**
 * Class Article
 * User: Jack<376927050@qq.com>
 * Date: 2019/3/12
 * Time: 15:37
 * @package app\front\widget
 */


namespace app\front\widget;

use app\common\model\Article as ArticleModel;

class Article
{
    public function showHot($num = 6,$keyword = '')
    {
        # heredoc
        $html = <<<HOT
    <div class="si-each">
        <div class="si-title"><span class="si-p3-top">TOP 10</span> 热门文章</div>
        <div class="si-p3">
            %s
        </div>
    </div>
HOT;
        $list = ArticleModel::all(function ($query) use($num){
                $query->where('status',ArticleModel::STATUS_PUBLISH)
                      ->order('view_total','DESC')
                      ->limit($num);
        });
        $content = '';
        foreach ($list as $art){
            $url = url('article/show',['aid'=>$art->id]);
            $content .= '<p><a href="'.$url.'">'.$art->title.'</a></p>';
        }
        return sprintf($html,$content);
    }
}