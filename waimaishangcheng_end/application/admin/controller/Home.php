<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 上午 11:34
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;

class Home extends Controller
{
	public function index()
	{
	    if ( Session::get('adminName') == null ){
	        $this->error('没有登陆，禁止入内！！！',"http://www.takeout.com/admin/login/index");
        }
		return $this->fetch();
	}
	public function isPost(Request $request)
    {
        $id = $request->post('id');
        Session::set('roleId',$id);
    }
	public function loginIndex()
    {
        $role = Session::get( 'roleId' );
        $name = Session::get( 'adminName' );
        if ( $role == 1 ){
            return json(['code' => 1,'name' => $name ]);
        }else if ( $role == 2 ){
            return json(['code' => 2,'name' => $name ]);
        }else if ( $role == 3 ){
            return json(['code' => 3,'name' => $name ]);
        }
        return json(['code' => 4]);
    }
	public function welcome()
    {
        return $this->fetch();
    }
    public function cate()
    {
        return $this->fetch();
    }
    public function back()
    {
        Session::delete('adminName');
        Session::delete('adminId');
        Session::delete('roleId');
        $this->success('退出成功',"http://www.takeout.com/admin/login/index");
    }

}
