<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/6 0006 / 下午 2:21
 */

namespace app\admin\validate;


class DataIsTrue
{
    public function DataResult()
    {
        $str = trim($_POST['name']);  //清理空格

        $str = strip_tags($str);   //过滤html标签

        $str = htmlspecialchars($str);   //将字符内容转化为html实体

        $str = addslashes($str);  //防止SQL注入

        echo $str;
    }
}