<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12 0012
 * Time: 下午 2:59
 */

namespace app\front\widget;


use app\service\BaseController;
use think\Cookie;

class BwHistory extends BaseController
{
    public function historyList()
    {
        //获取浏览历史数据
        $arr=unserialize(Cookie::get('bwhistory'));
       // dump($arr);die;
        $html=<<<HTML
          <div class="si-each">
            <div class="si-title">浏览历史</div>
            <div class="si-p2">
                %s
            </div>
        </div>
HTML;
        $content='';
        if($arr==null){
            $content='<p>暂无浏览历史</p>';
            return sprintf($html, $content);
        }
        foreach ( $arr as $k => $value ) {
            $url = url('module/show', [ 'id' => $k ]);
            $content .= "<p><a href='" . $url . "'>$value</a></p>";
        }
        return sprintf($html, $content);
    }

}