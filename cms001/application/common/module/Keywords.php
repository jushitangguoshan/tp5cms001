<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 3:03
     */

    namespace app\common\module;


    use think\Model;

    class Keywords extends Model
    {
        protected $autoWriteTimestamp=false;
        #关联文章g关系表关键字
        public function articleKeywordRelation()
        {
            return $this->hasMany('article_keyword_relation','keyword_id','id');
        }

        /**
         * 给关键字表模型和文章主表建立一个关联关系
         * @return \think\model\relation\BelongsToMany
         */
        public function article()
        {
            return $this->belongsToMany('Article','article_keyword_relation','article_id','keyword_id');
        }
    }