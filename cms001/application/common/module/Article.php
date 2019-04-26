<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 2:28
     */

    namespace app\common\module;
    use think\Model;
    use SoftDelete;
    class Article extends Model
    {
        use \traits\model\SoftDelete;
        protected $auto=['author_id'];//定义自动写入的字段
    
       // protected $insert = [];
        
        //设置作者id--------修改器
        public function setAuthorIdAttr()
        {
            return 123;
        }
        //获取文章关键词--------《获取器》
        public function getKeysAttr()
        {
            $arr=[];
            foreach( $this->keyword as $val ){
                $arr[]=$val['keyword'];
            }
            return implode(',',$arr);
        }
        #关联作者表
        public function author()
        {                           //要关联的模型m     m的主键             当前表的外键
            return $this->hasOne('user','id','author_id');
        }
        #关联栏目表
        public function category()
        {                          //要关联的模型m             当前模型的外键         m模型表的主键
            return $this->belongsTo('Category','category_id','id');
        }
        #关联文章内容表
        public function artInfo()
        {
            return $this->hasOne('ArticleInfo','aid','id');
        }
        #关联文章关键字
        public function keyword()
        {
            return $this->belongsToMany(
                    //要关联的模型k     中间关系表名                         中间表与k模型的外键        中间表与当前表的外键
                'Keywords','article_keyword_relation','keyword_id','article_id');
        }
    }