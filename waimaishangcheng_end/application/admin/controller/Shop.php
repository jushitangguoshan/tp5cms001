<?php
/**
 * 商铺管理系统
 * User: gaofengxin(13704659678@163.com)
 * Date: 2019/4/2 0002
 * Time: 下午 2:45
 */
namespace app\admin\controller;
use app\admin\service\BaseController;
use think\Exception;
use think\Request;
use think\Session;
use think\Url;

class Shop extends BaseController
{
    /**
     * @param Request $request
     * @return mixed
     * 新增商铺
     */
    public function shop_add(Request $request)
    {
        if( $request->isPost() ){
            $shopName = $request->post('shopName');
            $shopTip = $request->post('shopTip');
            $shopState = $request->post('shopState');
            $shopBlock = $request->post('shopBlock');
            $shopFloor = $request->post('shopFloor');
            $shopPhone = $request->post('shopPhone');
            if( request()->file('file') != null ){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public/uploads');
                $a=$info->getSaveName();
                $imgp= str_replace("\\","/",$a);
                $imgpath='uploads/'.$imgp;
            }else{
                throw new Exception(['errcode' =>300, 'msg' => '没有传输图片']);
            }
            $res =  new \app\common\model\Shop();
            $validate = validate("Shop");
            $result = $validate->scene('login')->check($shopPhone);
//            if(!$result){
//                $this->error('请输入手机号,手机号码不能超过11位,手机号码格式不正确');
//            }
            $res -> data([
                'name'        =>   $shopName,
                'user_id'     =>   Session::get('adminId'),
                'shop_phone'  =>   $shopPhone,
                'notice'      =>   $shopTip,
                'status'      =>   $shopState,
                'building'    =>   $shopBlock,
                'floor'       =>   $shopFloor,
                'image'       =>   $imgpath,
                'create_time' =>   date('Y-m-d H:i:s',time())
            ])->save();
            if( $res ){
                $this->success('添加成功');
            }else{
                throw new Exception(['errcode' =>500, 'msg' => '系统内部错误']);
            }
        }
        return $this->fetch();
    }

    /**
     * 渲染页面
     * @return mixed
     */
    public function shop_list()
    {
        return $this->fetch();
    }
    /**
     * 获取遍历数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get_shop_list(Request $request)
    {
        $res = ( new \app\common\model\Shop());
        $page = $request->get('page');
        $limit = $request->get('limit');
        $list = $res ->page($page,$limit)->select();
        foreach ( $list as $value => $key){
            if(  $key['status'] == 0 ){
                $list[$value]['status'] = '休息';
            }else if( $key['status'] == 1 ){
                $list[$value]['status'] = '营业';
            }
        }
        $arr = [];
        foreach ($list as $value){
            $arr[] = ['name'=>$value->name,'id'=>$value->id,'status'=>$value->status,'notice'=>$value->notice,'image'=>$value->image];
        }
        $count = $res -> where('status',1) -> count('id');
        return json(['data'=>$arr,'msg'=>'','count'=>$count,'code'=>0]);
    }
    /**
     * 对象转换成数组
     * @param $obj
     * @return array|void
     */
    public function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)$this->object_to_array($v);
            }
        }
        return $obj;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 修改商铺
     */
    public function shop_edit(Request $request)
    {
        $id = $request->get('id');
        $res = ( new \app\common\model\Shop());
        $list = $res -> where('id',$id) -> select();
        if( $request->isPost() ){
            $shopName = $request->post('shopName');
            $shopTip = $request->post('shopTip');
            $shopState = $request->post('shopState');
            $shopBlock = $request->post('shopBlock');
            $shopFloor = $request->post('shopFloor');
            $shopPhone = $request->post('shopPhone');
            $file = $request->file('myFile');
            $info = $file->move(ROOT_PATH . 'public/uploads');
            $a=$info->getSaveName();
            $imgp= str_replace("\\","/",$a);
            $imgpath='uploads/'.$imgp;
            $res =  new \app\common\model\Shop();
            $validate = validate("Shop");
            $result = $validate->scene('login')->check($shopPhone);
            if(!$result){
                $this->error('请输入手机号,手机号码不能超过11位,手机号码格式不正确');
            }
            $res->save([
                'name'        =>    $shopName,
                'user_id'     =>    Session::get('adminId'),
                'shop_phone'  =>    $shopPhone,
                'notice'      =>    $shopTip,
                'status'      =>    $shopState,
                'building'    =>    $shopBlock,
                'floor'       =>    $shopFloor,
                'image'       =>    $imgpath,
                'update_time' =>    date('Y-m-d H:i:s',time())
            ],['id' => $id]);
            if( $res ){
                $this->success('修改成功');
            }else{
                throw new Exception(['errcode' =>500, 'msg' => '系统内部错误']);
            }
        }
        return $this->fetch('shop/shop_edit',['list'=>$list]);
    }
    /**
     * @param Request $request
     * 删除数据
     */
    public function shop_del(Request $request)
    {
        $id = $request->get('id');
        $res = \app\common\model\Shop::destroy($id);
        if( $res ){
            $this->success('删除成功','shop/shop_add');
        }else{
            throw new Exception(['errcode' =>500, 'msg' => '系统内部错误']);
        }
    }
}