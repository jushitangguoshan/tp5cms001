<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 3:03
     */

    namespace app\common\module;
    use think\Model;
    use SoftDelete;
    class Category extends  Model
    {
        use \traits\model\SoftDelete;
        protected static $deleteTime = 'delete_time';
        //关联文章表
        public function article()
        {
            return $this->hasMany('Article','id','category_id');
        }
        public function ArticleKeywordRelation()
        {
            return $this->hasMany('ArticleKeywordRelation','id');
        }

    }