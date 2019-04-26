<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12 0012
 * Time: 下午 2:20
 */

namespace app\front\widget;

use app\service\BaseController;

class Category extends BaseController
{
    #显示栏目列表--在布局文件中显示
    public function lists()
    {
        //如果存在栏目id
        if ( input('cid') ) {
            $cid = input('cid');
        }
        else if ( $id = input('id') ) {//如果存在文章id
            $art = \app\common\module\Article::where('id', $id)->field('category_id')->find();
            $cid = $art->category_id;
        }
        else {
            $cid = 0;
        }
        $colName = \app\common\module\Category::all(function( $query ) use ( $cid ) {
            $query->where('parent_id', $cid)->field('id,category_name');
        });
        $html = <<<COL
               <div class="si-each">
                    <div class="si-title">内容栏目</div>
                    <div class="si-p1">
                        %s
                    </div>
				</div>
COL;
        $content = '';
        foreach ( $colName as $k => $value ) {
            $url = url('module/lists', [ 'cid' => $value['id'] ]);
            $content .= "<a href='" . $url . "'>$value[category_name]</a>";
        }
        return sprintf($html, $content);
    }
    
    //获取主栏目----在页面顶部显示
    public function p_category()
    {
        $colArr = \app\common\module\Category::all(function( $query ) {
            $query->where('delete_time')
                ->where('parent_id', 0)
                ->field('id,category_name');
        });
        $html = <<<COL
               <div class="top-nav top-col">
					<a href="http://www.tp5.com/front/home/index" class="curr">首页</a>
					%s
					<a href="about.php" class="">联系我们</a>
				</div>
COL;
        $content = '';
        foreach ( $colArr as $value ) {
            $url = url('module/lists', [ 'cid' => $value['id'] ]);
            $content .= "<a href='" . $url . "' class=''>$value[category_name]</a>";
        }
        return sprintf($html, $content);
    }
}