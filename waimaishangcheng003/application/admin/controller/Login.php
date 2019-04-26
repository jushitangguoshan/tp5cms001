<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 2:13
 */
namespace app\admin\controller;

use app\admin\service\BaseController;
use app\common\model\AdminRole;
use think\Request;
use think\Session;

class Login extends BaseController
{
    public function index()
    {
        return $this->fetch();
    }
    public function choose()
    {
        return $this->fetch();
    }
    public function login_index(Request $request)
    {
        if( $request->isAjax() ){
            $name = $request->post('name');
            $pwd = $request->post('pwd');
            if(empty($name) || empty($pwd)){
                $this->error('用户名不能为空或者密码不能为空','','0');
            }
            $res = new \app\common\model\Admin();
            if( $name == 'admin' && $pwd == '123'){
                $superAdmin = $res -> where('name','admin') -> where('pwd',123) -> find();
                Session::set('adminName','admin');
                Session::set('adminId',$superAdmin['id']);
                return json(['code'=>1,"msg" => "超级管理员登陆"]);
            }else{
                $admin = $res -> where('name',$name) -> where('pwd',md5($pwd.'123456')) -> find();
                if( $admin == null ){
                    return json(['code' => 0,"msg" => '用户名不存在或者密码错误']);
                }
                $role = new AdminRole();
                $r = $role -> where('admin_id',$admin->id)->select();
                if( count($r) > 1 ){
                    Session::set('adminName',$name);
                    Session::set('adminId',$admin['id']);
                    return json(['code' => 4]);
                }else{
                    if( $r[0]['role_id'] == 2 ){
                        Session::set('adminName',$name);
                        Session::set('adminId',$admin['id']);
                        return json(['code' => 2,"data" => 2,'msg' => '客服人员登陆']);
                    }else if( $r[0]['role_id'] == 3 ){
                        Session::set('adminName',$name);
                        Session::set('adminId',$admin['id']);
                        return json(['code' => 3,"data" => 3,'msg' => '店铺管理员登陆']);
                    }
                }
            }
        }
        return true;
    }
    public function adminChoose()
    {
        $id = Session::get('adminId');
        $role = new AdminRole();
        $r = $role -> where('admin_id',$id)->select();
        $roleIds = [];
        foreach ( $r as $key => $value ){
            $roleIds[] = $r[$key]['role_id'];
        }
        return json(['code' => 1,"data" => $roleIds]);
    }

//    public function sendMsg()
//    {
//        $re = \Aliyun\SMS::getInstance()->sendMobileVerifyCode('18581500128');
//        var_dump($re);
//    }

}