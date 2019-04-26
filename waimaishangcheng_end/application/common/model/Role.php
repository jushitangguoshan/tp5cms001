<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/4 0004 / 下午 3:06
 */
namespace app\common\model;
use think\Model;
class Role extends Model
{
    public function getAdminInfoArr()
    {
        return  $this->belongsToMany('Admin', 'admin_role','admin_id', 'role_id');
    }
}