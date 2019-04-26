<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 4:48
     */

    namespace app\service;


    use app\common\module\Article;
    use app\common\module\ArticleKeywordRelation;
    use app\common\module\Keywords;
    use think\Db;

    class ArticleService
    {
        //添加文章关键字数据
        public static function addKeyword($aid,$keywords)
        {
            //将关键字字符串进行处理---》最终得到关键字数组
            $arrKeywords = strpos($keywords,',')===false ? (array)$keywords : explode(',',$keywords);
            foreach( $arrKeywords as $v ){
                if($v=='')break;//关键字为空--结束本次循环
                //获取Keywords表中字段Keyword=$v的数据
                $row=Keywords::get(['keyword'=>$v]);
                ///先判断是否有关键字表中是否有该文章的关键字-》如果没有该关键字--则追加一个
                if(!$row){
                    Keywords::create(['keyword'=>$v]);//插入一个关键字
                }//此时的$row=['id'=>$a,'keyword'=>$b];
                //获取该关键字的id
                $addId=Keywords::where('keyword',$v)->value('id');
                //插入关键字与文章的关系----
                Db::name('Article_keyword_relation')->insert(['article_id'=>$aid,'keyword_id'=>$addId]);
            }
            return true;
        }
        //更新文章关键字数据
        public static function updaKeyword($aid,$keywords)
        {
            //该文章--《新的关键字数组
            $nowKeys = strpos($keywords,',')===false ? (array)$keywords : explode(',',$keywords);
            //该文章--《旧的的关键字数组
            $art=Article::get(input('id'));
            $oldKeys=explode(',',$art->getKeysAttr());
            //取出新、旧关键字数组的差集
            $delRelation=array_diff($oldKeys,$nowKeys);//需要从关系表移除关系的【文章-》关系】
            $addRelation=array_diff($nowKeys,$oldKeys);//需要加入到关系表的【文章-》关系】
            //判断关键字是否有改变---【没有改变则：return true------》有改变--往下走】
            if( empty($addRelation) && empty($delRelation) )return true;
           //【删除旧数组里面的、新增新数组里面的关键字】
            //新增--【没有该关键字则新增关键字】--->再新增关系关键字与文章关系数据》
            foreach( $addRelation as $v ){
                if($v=='')break;//关键字为空--结束本次循环
                $row=Keywords::get(['keyword'=>$v]);//获取Keywords表中字段Keyword=$v的数据
                if(!$row){ //[没有该关键字------》先插入一个关键字-----》再增加一个当前文章与该关键字的关系]
                    Keywords::create(['keyword'=>$v]);//插入一个关键字
                }
                $upId=Keywords::where('keyword',$v)->value('id'); //获取该关键字的id
                Db::table('Article_keyword_relation')->insert(['article_id'=>$aid,'keyword_id'=>$upId]);
            }
            //删除--关系表中该关键字与文章关系
            //---查找当前关键字对应得id--->再到关系表删除该关键字与文章的关系数据（where article_id=$aid）;
            foreach( $delRelation as $v ){
                if($v=='')break;//关键字为空--结束本次循环
                $key=Keywords::get(['keyword'=>$v]); //获取当前关键字id
                $relation=ArticleKeywordRelation::get(['keyword_id'=>$key->id,'article_id'=>$aid]); //找到该关键字与文章关系的那条数据
                $relation->delete();//删除
                $relationArr=ArticleKeywordRelation::get(['keyword_id'=>$key->id]);//获取该关键字对应的关系数组(包含所有文章)
                if(empty($relationArr)){//如果该关键字没有与其他文章有关系，则删除该关键字
                    $key::where('id', $key->id)->update(['delete_time' => date("Y-m-d H:i:s",time())]);
                };
            }
            return true;
        }


    }