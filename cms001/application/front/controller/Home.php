<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/2 0002
     * Time: 下午 7:08
     */
    namespace app\front\controller;
    use app\common\module\Article;
    use app\service\BaseController;
    class Home extends BaseController
    {
        public function index()
        {
            //通过模型获取文章所有数据
            $articleArr=Article::where('delete_time')
                ->order('id','asc')
                ->paginate(3);
            $this->assign(['list'=>$articleArr]);
            return $this->fetch();
        }
    }