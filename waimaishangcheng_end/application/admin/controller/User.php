<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/6 0006 / 下午 8:57
 */

namespace app\admin\controller;


use app\admin\service\BaseController;

class User extends BaseController
{
    public function member_list()
    {
        return view();
    }

    /**
     * 用户列表
     * @return array
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userList()
    {
        $limit = input('limit');
        $page = input('page');
        $userModel = new \app\common\model\User();
        $userArr = $userModel
            ->page($page,$limit)
            ->select();
        if( $userArr ){
            $list = [];
            foreach ($userArr as $key => $val){
                $list[$key]['id']=$val->id;
                $list[$key]['nick']=$val->nick;
                $list[$key]['username']=$val->username;
                $list[$key]['sex']=$val->sex;
                $list[$key]['phone']=$val->phone;
                $list[$key]['status']=$val->status;
                $list[$key]['create_time']=$val->create_time;
            }
            $count = $userModel->count();
            return ['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];
        }
        throw new Exception('系统内部错误','500');
    }
}