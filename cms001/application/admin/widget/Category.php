<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/12 0012
     * Time: 上午 10:42
     */

    namespace app\admin\widget;


    use app\service\BaseController;
    use think\Db;

    class Category extends BaseController
    {
        public function colList()
        {
             return  $this->getListOption($this->getColArr());
        }
        //得到栏目拼接的 option
        public   function getColArr()
        {
            $category=Db::name('category')
                ->field('id,category_name,parent_id,sort')
                ->where('delete_time')
                ->order('sort','asc')
                ->select();
            $arrCol=$this->getColumnTree($category);//获取栏目数组---二维
            return $arrCol;
        }
        //得到栏目
        private function getListOption($data,$level = 0)
        {
            $html = '';
            foreach ($data as $k=>$item){
                for ($i=0;$i<$level;$i++){
                    $html .= '<option value="'.$item['id'].'"  >----'.$item["category_name"].'</option>';
                }
                $html .=($level==0) ? '<option value="'.$item['id'].'">'.$item['category_name'].'</option>' : '';
                $html .= isset($item['_child']) ? $this->getListOption($item['_child'],$level+1) :'';

            }
            return $html;
        }
        //得到栏目的二维数组
        private function getColumnTree($list,$pk='id',$pid='parent_id',$child='_child',$root=0){
            $tree=array();
            foreach($list as $key=> $val){
                if($val[$pid]==$root){  //获取当前$pid所有子类
                    unset( $list[$key] );
                    if( !empty($list) ){
                        $child=$this->getColumnTree($list,$pk,$pid,$child,$val[$pk]);
                        if(!empty($child))  $val['_child']=$child;
                    }
                    $tree[]=$val;
                }
            }
            return $tree;
        }
    }