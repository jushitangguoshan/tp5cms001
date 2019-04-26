<?php
/**
 * 商品管理控制器
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/3 0003
 * Time: 上午 8:52
 */

namespace app\admin\controller;


use app\admin\service\BaseController;
use think\Db;
use think\Exception;
use think\Session;

class Goods extends BaseController
{
    /**
     * 显示商品添加页面
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add_goods()
    {
        $create_host = Session::get('adminId');
        if($create_host != 4){
            $list = Db::name('shop')->where('user_id',$create_host)->find();
        }else{
            $list = '';
        }
        $this->assign(['list'=>$list]);
        return $this->fetch();
    }

    /**
     * 添加商品
     * @return \think\response\Json
     * @throws Exception
     */
    public function add()
    {
        $request = request();
        if(!$request->isAjax()){
            throw new Exception();
        }
        $goodsModel = new \app\common\model\Goods();
        $data = $request->post();
        $validate = new \app\admin\validate\Goods();
        if(!$validate->check($data)){
            return json(['code'=>500,'msg'=>'添加失败！数据异常']);
        }
        $create_host = Session::get('adminId');
        if($create_host == 4){
            $shopId = $request->post('belong_store_id');
            $res = Db::name('shop')->where('id',$shopId)->value('user_id');
            $data['create_host'] = $res;
        }else{
            $data['create_host'] = $create_host;
        }
        $data['create_time'] = time();
        $res = $goodsModel->allowField(true)->save($data);
        if($res){
            return json(['code'=>0,'msg'=>'添加成功']);
        }else{
            return json(['code'=>400,'msg'=>'添加失败']);
        }
    }

    /**
     * 获取layui上传的图片，并返回路径
     * @return \think\response\Json
     */
    public function getImg()
    {
        $img = request()->file('file');
        $info = $img->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            return json(['code' => 0, 'msg' => '上传成功!', 'url' => '/uploads/' . $info->getSaveName()]);
        }else{
            // 上传失败获取错误信息
            return json(['code' => 1, 'msg' => $img->getError(), 'url' => '']);
        }
    }
    /**
     * 显示商品列表页面
     * @return mixed
     */
    public function goods_list()
    {
        return $this->fetch();
    }

    /**
     * 遍历商品数据并返回
     */
    public function showList()
    {
        $adminId = Session::get('adminId');
        $roleArr = Db::name('admin_role')->where('admin_id',$adminId)->column('role_id');
        $goodsModel = new \app\common\model\Goods();
        $page = request()->get('page');
        $limit = request()->get('limit');
        $mark = false;
        foreach ($roleArr as $val){
            if($val == 1){
                $mark = true;
                break;
            }
        }
        if($mark){
            $data = $goodsModel
                ->where('storage','>',0)
                ->page($page,$limit)
                ->select();
        }else{
            $data = $goodsModel
                ->where('storage','>',0)
                ->where('create_host',$adminId)
                ->page($page,$limit)
                ->select();
        }
        $list = [];
        foreach ($data as $role){
            array_push($list,[
                'id' => $role->id,
                'goods_name' => $role->goods_name,
                'belong_store_id' => $role->getStoreName->name,
                'belong_category_id'  => $role->getCategoryName->category_name,
                'price'  => $role->price,
                'create_time' => $role->create_time,
                'image' => $role->image
            ]);
        }
        $count = $goodsModel->count('id');
        return json(['msg'=>'','data'=>$list,'count'=>$count,'code'=>0]);
    }


    /**
     * 商品删除，软删除
     * @return \think\response\Json
     */
    public function del()
    {
        $id = request()->post('id');
        $res = \app\common\model\Goods::destroy($id);
        if($res){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>400,'msg'=>'删除失败']);
        }
    }

    /**
     * 显示编辑商品页面
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit_goods()
    {
        $id = request()->get('act');
        $goodsModel = new \app\common\model\Goods();
        $list = $goodsModel->where('id',$id)->find();
        if ( $list ){
            return $this->fetch('edit_goods',['list'=>$list]);
        }
        throw new \Exception("系统内部错误","500");
    }

    /**
     * 修改商品
     * @return \think\response\Json
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $goodsModel = new \app\common\model\Goods();
        $id = request()->post('id');
        //排除请求中的id
        $data = request()->except(['id']);
        $validate = new \app\admin\validate\Goods();
           if(!$validate->check($data)){
               return json(['code'=>500,'msg'=>'修改失败！数据异常']);
           }
        $resArr = $goodsModel->where('id',$id)->find();
        if( !$resArr ){
            throw new Exception();
        }else{
            $list = [
                'num' => '123456',
                'goods_name'    => $resArr->goods_name,
                'belong_store_id'    => $resArr->belong_store_id,
                'belong_category_id'    => $resArr->belong_category_id,
                'price'    => $resArr->price,
                'storage' => $resArr->storage,
                'image'    => $resArr->image
            ];
            $diff = array_diff($data,$list);
            if(!$diff){
                return json(['code'=>300,'msg'=>'没有更新任何信息']);
            }
            $diff['update_time'] = time();
            $res = $goodsModel->allowField(true)->save($diff, ['id' => $id]);
            if($res){
                return json(['code'=>0,'msg'=>'修改成功','data'=>$diff]);
            }else{
                return json(['code'=>400,'msg'=>'修改失败']);
            }
        }
    }

    /**
     * 处理编辑时候的图片,select赋值
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function editUploadImg()
    {
        $id = request()->post('id');
        $res = \app\common\model\Goods::get($id);
        $image = $res->image;
        $shop_id = $res->belong_store_id;
        $category_id = $res->belong_category_id;
        return json(['code' => 0, 'data' => [$shop_id,$category_id], 'url' => $image]);
    }
}