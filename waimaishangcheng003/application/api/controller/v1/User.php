<?php
/**
 * 关于用户的api
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/8 0008
 * Time: 下午 6:58
 */

namespace app\api\controller\v1;
use app\front\validate\Login;
use think\Db;
use think\Exception;
use think\Request;


use think\Controller;

class User extends Controller
{
    /**
     * 登录
     * @return \think\response\Json
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $request = Request::instance();
        if(!$request->isAjax() || !$request->isPost()){
            return json(['errcode'=>404,'msg'=>'无效参数']);
        }
        $validate = new Login();
        if(!$validate->check($request->post())){
            throw new Exception('数据有误');
        }
        $phone = $request->post('phone');
        $list =  Db::name('user')->where('phone',$phone)->find();
        if(!$list){
            return json(['errcode'=>300,'msg'=>'账号错误']);
        }
        $pwd = $request->post('pwd');
        if($list['pwd'] === $pwd){
            return json(['errcode'=>0,'msg'=>'登录成功','data'=>$list['id']]);
        }else{
            return json(['errcode'=>300,'msg'=>'密码错误']);
        }
    }

    /**
     * 注册
     * @return \think\response\Json
     */
    public function register()
    {
        $request = Request::instance();
        if(!$request->isAjax() || !$request->isPost()){
            return json(['errcode'=>500,'msg'=>'系统内部错误']);
        }
        $data = $request->post();
        $userModel = new \app\common\model\User();
        $data['create_time'] = time();
        $data['status'] = 1;
        $result = $userModel->allowField(true)->save($data);
        if(!$result){
            return json(['errcode'=>300,'msg'=>'数据有误']);
        }else{
            return json(['errcode'=>0,'msg'=>'注册成功']);
        }
    }

}