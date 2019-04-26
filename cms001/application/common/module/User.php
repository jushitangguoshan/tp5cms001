<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 3:02
     */

    namespace app\common\module;
    use think\Model;

    class User extends Model
    {
        /*
         * 建立一个一度一相对关联表
         */
        //关联文章表
        public function article()
        {
            return $this->belongsTo('article');
        }
        public function  getStatusAttr($value)
        {
            $status = [1=>'admin',100=>'super'];
            return $status[$value];
        }

    }