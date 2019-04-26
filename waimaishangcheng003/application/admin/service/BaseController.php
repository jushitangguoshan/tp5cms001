<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 2:41
 */

namespace app\admin\service;
use think\Controller;
class BaseController extends Controller
{
    /**
     * 获取当前登录的后台人员信息
     * @return bool|mixed
     */
    private function getAdminInfo()
    {
        $adminInfo = Session::get("adminName","admin");
        if( $adminInfo == null ){
            return false;
        }
        return $adminInfo;
    }
}