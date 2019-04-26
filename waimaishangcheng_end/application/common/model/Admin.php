<?php
/**
 * 管理系统
 * User: gaofengxin(13704659678@163.com)
 * Date: 2019/4/4 0004
 * Time: 上午 11:41
 */

namespace app\common\model;
use think\Model;

class Admin extends Model
{
    protected $createTima = 'create_time';

    /**
     * 关联角色信息表
     * @return \think\model\relation\BelongsToMany
     */
    public function getRolesArr()
    {
        return $this->belongsToMany('role');
        //return $this->belongsToMany('role','admin_role','admin_id','role_id');
    }

    /**
     * 关联角色关系表
     * @return \think\model\relation\HasMany
     */
    public function getAdminRoleArr()
    {
        return $this->hasMany('Admin_role','admin_id','id');
    }

    /**
     * 建立 店铺管理员 与 店铺  的关系表【一对一】
     * @return \think\model\relation\HasOne
     */
    public function getStoreInfo()
    {
        return $this->hasOne('Shop','user_id','id');
    }
}