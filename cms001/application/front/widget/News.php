<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/13 0013
 * Time: 上午 10:34
 */

namespace app\front\widget;


class News
{
    public function lists()
    {
        //初始化----[get---test]
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "http://v.juhe.cn/toutiao/index?type=get&key=cc7dcb00013cb2127ac6ce50c42eb64e");
        //设置是否将响应结果存入变量，1是存入，0是直接echo出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        print_r(json_decode($output,true));
       //【post---test】
//        $data=array(
//        "name" => "Lei",
//        "msg" => "Are you OK?"
//        );
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, "http://测试服务器的IP马赛克/testRespond.php");
//        curl_setopt($ch, CURLOPT_POST, 1);
//        //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
//        curl_setopt($ch, CURLOPT_POSTFIELDS , http_build_query($data));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $output = curl_exec($ch);
//
//        echo $output;
//
//        curl_close($ch);
    }
}