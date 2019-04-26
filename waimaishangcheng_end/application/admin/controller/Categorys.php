<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2019/4/2 0002
 * Time: 下午 2:15
 */
namespace app\admin\controller;
use app\admin\service\BaseController;
use app\common\model\Category;
use think\Hook;
use think\Request;
use think\Session;

class Categorys extends BaseController
{
    /**
     * 栏目增加页面
     * @return mixed | bool
     */
    public function category_add()
    {
        return $this->fetch();
    }
    /**
     * 栏目增加提交处理
     */
    public function categoryAddHandle()
    {
        //监听是否是ajax请求
        Hook::listen("checkIsAjax");
        #数据处理
        $data = Request::instance()->post();
        $data['masterId'] = 1;//------》随便给的
        $data['create_time'] = time();
        $data['status'] = 1;
        #插入数据表
        $category = new Category($data);
        $results = $category->save();
        #插入结果判断
        if( $results == null ){
            throw new \Exception("系统内部错误","500");
        }
        echo json_encode(['code'=>100,'msg'=>"添加成功"]);
    }

    /**
     * 获取栏目列表
     * @return mixed array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function category_list()
    {
       $masterId =  Session::get('adminId');

       if( Session::get('roleId') == 1 ){
           $categoryList = Category::where('id','>',0)->select();
       }else{
           $categoryList = Category::where('masterId',$masterId)->order('weight asc')->select();
       }
        if( !$categoryList ){
            throw new \Exception("系统内部错误","500");
        }
        $this->assign(["categoryList"=>$categoryList]);
        return $this->fetch();
    }
    /**
     * 栏目删除
     * @throws \Exception
     */
    public function category_del()
    {
        $categoryId = Request::instance()->post();
        if( !Category::destroy($categoryId) ){
            throw new \Exception("系统内部错误","500");
        }
        echo json_encode(['code'=>100,'msg'=>"删除成功"]);
    }

    /**
     * 修改栏目状态
     * @throws \Exception
     */
    public function updateCategoryStatus()
    {
        $data = Request::instance()->post();
        if( !Category::where("id",$data['id'])->Update($data) ){
            throw new \Exception("系统内部错误","500");
        }
        echo json_encode(['code'=>100,'msg'=>"操作成功"]);
    }

    /**
     * 获取编辑的栏目信息
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function category_edit()
    {
        $id = Request::instance()->get('id');
        if( !($data=Category::get($id)) ){
            throw new \Exception("系统内部错误","500");
        }
        $this->assign(['data'=>$data]);
        return $this->fetch();
    }
    public function categoryEditHandle()
    {

        $data = input();
        $data['status'] = array_key_exists('status',$data) ? 1 : 0;
        $category = new Category();
        if( !$res = $category->isUpdate(true)->save($data) ){
            throw new \Exception("系统内部错误","500");
        }
        if( ! $res = $category->isUpdate(true)->save(['update_time' => time(),'id'=>$data['id']]) ){
            throw new \Exception("系统内部错误","500");
        }
        echo json_encode(['code'=>100,'msg'=>"操作成功"]);
    }
}