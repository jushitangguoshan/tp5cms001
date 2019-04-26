<?php
/**
 * 商品表模型
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/3 0003
 * Time: 上午 8:51
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    use SoftDelete;
    protected static $deleteTime = 'delete_time';

    /**
     * 商品和分类的一对一关系
     * @return \think\model\relation\HasOne
     */
    public function getCategoryName()
    {
        return $this->hasOne('Category', 'id', 'belong_category_id');
        //$this->hasOne(关联模型的类名, 关联模型的外键, 当前模型的关联键);
    }

    /**
     * 商品属于店铺的关系
     * @return \think\model\relation\BelongsTo
     */
    public function getStoreName()
    {
        return $this->belongsTo('Shop','belong_store_id','id');
        //$this->belongsTo(关联模型的类名, 当前模型的外键, 当前模型的主键);
    }

}