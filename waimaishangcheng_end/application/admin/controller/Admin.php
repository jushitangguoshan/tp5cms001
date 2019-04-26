<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/2 0002
 * Time: 下午 2:23
 */

namespace app\admin\controller;
use app\admin\service\BaseController;
use app\common\model\AdminRole;
use app\common\model\Role;
use think\Db;
use think\Exception;
use think\Request;

class Admin extends BaseController
{
    /*
     * 管理员列表--页面渲染
     */
    public function admin_list()
    {
        return $this->fetch();
    }
    /**
     * 获取管理员数据
     */
    public function getAdminList(Request $request)
    {
        if( $request->isGet() ){
            $limit = input('limit');
            $page = input('page');
            $adminModel = new \app\common\model\Admin();
            $adminArr = $adminModel
                ->field('id,name,email,phone,status,create_time')
                ->page($page,$limit)
                ->select();
            if( $adminArr ){
                $list = [];
                foreach ($adminArr as $key => $val){
                    $list[$key]['id']=$val->id;
                    $list[$key]['name']=$val->name;
                    $list[$key]['email']=$val->email;
                    $list[$key]['roles']=$this->getRoleStr($val->id);
                    $list[$key]['phone']=$val->phone;
                    $list[$key]['status']=$val->status;
                    $list[$key]['create_time']=$val->create_time;
                    $list[$key]['update_time']=$val->update_time;
                }
                $count = $adminModel->count();
                //  print_r($list);die;
                return ['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
            }
            throw new Exception('系统内部错误','500');
        }
        throw new Exception('没有任何数据传输','300');
    }

    /**
     * 获取角色字符串
     */
    public function getRoleStr($id)
    {
        $adminModel = \app\common\model\Admin::get($id);
        $roleArr = $adminModel->getRolesArr;
        $arr=[];
        foreach ($roleArr as $v){
            $arr[$v->id]=$v->role_name;
        }
        //如果是超级管理员
        if( array_key_exists(1,$arr) ){
            return $arr[1];
        }
        return implode(" ，",$arr);
    }
    /**
     * 更新管理员状态
     * @throws \Exception\
     */
    public function adminUpdateStatus()
    {
        $data = input();
        if( !\app\common\model\Admin::update($data) ){
            throw new \Exception('系统内部错误','500');
        }
        echo json_encode(['code'=>100,'msg'=>'修改成功']);
    }
    /**
     * 管理员信息修改页面赋初值--渲染页面
     */
    public function admin_edit()
    {
        $adminId = Request::instance()->get('id');
        $adminInfo = \app\common\model\Admin::get(function ($query) use ($adminId){
            $query->where('id',$adminId)->field('id,name,email,phone,status,update_time');
        })->toArray();
        if ( $adminInfo ){
            // $data = $adminModel->where('id',$adminId)->field('id,name,email,phone,update_time')->find()->toArray();
            $adminModel = \app\common\model\Admin::get($adminId);
            $roleArr = $adminModel->getRolesArr;
            $arr=[];
            foreach ($roleArr as $v){
                $arr[]=$v->id;
            }
            $adminInfo['role'] = $arr;
            $this->assign(['data'=>$adminInfo]);
            return $this->fetch();
        }
        throw new Exception('系统内部错误','500');
    }
    /*
     * 管理员修改信息处理--提交修改后
     */
    public function adminEditHandle()
    {
        $data = input();
        $data['update_time'] = strtotime($data['update_time']);
        #新的管理员权限数组
        $adminNewroleArr = array_keys($data['role']);
        $adminModel = \app\common\model\Admin::get($data['id']);
        $roleArr = $adminModel->getRolesArr;
        $adminOldRoleArr=[];
        foreach ($roleArr as $v){
            //修改之前的管理员权限数组
            $adminOldRoleArr[]=$v->id;
        }
        Db::startTrans();
        try{
            $isChange = false;
            #需要插入的用户角色关系
            $adminRoleModel = new AdminRole();
            $addRoles = array_diff($adminNewroleArr,$adminOldRoleArr);
            if( $addRoles ){
                foreach ($addRoles as $v) {
                    $adminRoleModel->admin_id = $data['id'];
                    $adminRoleModel->role_id = $v;
                    if( !$adminRoleModel->save() ){
                        throw new \Exception("系统内部错误",'500');
                    }
                }
                $isChange = true;
            }
            #需要删除的用户角色关系
            $delRoles = array_diff($adminOldRoleArr,$adminNewroleArr);
            if( $delRoles ){
                foreach ($delRoles as $v) {
                    Db::name('admin_role')->where(['admin_id' => $data['id'],"role_id" => $v])->delete();
                }
                $isChange = true;
            }
            #更新管理员信息
            $adminModel = new \app\common\model\Admin();
            if( !$adminModel->allowField(true)->save($data,['id'=>$data['id']]) ){
                if( !$isChange ){
                    return  json(['code'=>101, 'msg'=>"修改失败"]);
                }
            }
            DB::commit();
            $data['roles'] = $this->getRoleStr($data['id']);
            return  json(['code'=>100, 'msg'=>"修改成功",'data'=>$data]);
        }catch (Exception $e){
            Db::rollback();
            return  json(['code'=>101, 'msg'=>"修改失败"]);
        }
    }
    /**管理员增加--页面渲染
     * @return mixed
     */
    public function admin_add()
    {
        return view();
    }

    /**
     * 增加管理人员
     */
    public function adminAddHandle()
    {
        $data = input();
        #判断用户名重复
        if( \app\common\model\Admin::get(['name'=>$data['name']]) ){
            return  json(['code'=>101, 'msg'=>"管理员名称重复"]);
        }
        $data['salt'] = "123456";
        $data['pwd'] = md5($data['pwd'].$data['salt']);
        #判断是否选择权限
        Db::startTrans();
        try{
            $adminModel = new \app\common\model\Admin($data);
            if( !$adminModel->allowField(true)->save() ){
                throw new Exception("添加失败");
            }
            #获取自增id
            $adminId = $adminModel->id;
            if( !array_key_exists('role',$data) ){
                return  json(['code'=>101, 'msg'=>"请选择管理员权限"]);
            }
            foreach ( $data['role'] as $k=>$v ){
                $roleArr[]=['role_id'=>$k,'admin_id'=>$adminId];
            }
            $adminRoleModel = new AdminRole();
            if( !$adminRoleModel->saveAll($roleArr) ){
                throw new Exception("添加失败");
            }
            Db::commit();
            return  json(['code'=>100, 'msg'=>"添加成功"]);
        }catch (\Exception $e){
            Db::rollback();
            return  json(['code'=>101, 'msg'=>"添加失败"]);
        }
    }
    /*
     * 管理员角色--页面渲染
     */
    public function adminRoleList()
    {
        return view();
    }
    public function getAdminRoleList()
    {
        $data = Db::name('role')->select();
        if ( $data ){
            return ['code'=>0,'msg'=>'','count'=>1,'data'=>$data];
        }
        throw new Exception('系统内部错误','500');

    }
}