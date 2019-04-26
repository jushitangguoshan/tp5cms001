<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/13 0013
 * Time: 上午 11:30
 */

namespace app\front\widget;

use think\Cache;

class Joke
{
    public function lists( $page = 1, $pagesize = 3 )
    {
        //判断是否有缓存
        if( Cache::get('joke') ){
            $arr = Cache::get('joke');
        }
        else{
            //初始化url
            $url = 'http://v.juhe.cn/joke/content/list.php?sort=&page='.$page.'&pagesize='.$pagesize.'&time='.time().'&key=2efc86b266b4e46a72713847b990e257';
            $ch = curl_init($url);
            //设置是否将响应结果存入变量，1是存入，0是直接echo出
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $output = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($output, true)[ 'result' ][ 'data' ];
            Cache::set('joke', $arr);
        }
        $html = <<<HTML
          <div class="si-each">
            <div class='si-title'><h2>笑话段子</h2></div>
            <div class="">
            %s
            </div>
        </div>
HTML;
        $content = '';
        foreach( $arr as $k => $value ){
            $content .= ( ++$k ).".<p>".$value[ 'content' ]."</p><hr>";
        }
        return sprintf($html, $content);
    }
    public function https_request( $url, $data = null )
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if( !empty($data) ){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}