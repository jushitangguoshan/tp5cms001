<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 4:29
 */
namespace app\common\model;
use think\Model;
use traits\model\SoftDelete;

class Shop extends Model
{
    use SoftDelete;
    protected static $deleteTime = 'delete_time';

    public function getIdAttr($box)
    {
        return $box;
    }
}