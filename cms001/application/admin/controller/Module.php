<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/6 0006
 * Time: 下午 2:10
 */

namespace app\admin\controller;

use app\admin\dateValidate\ArticleData;
use app\admin\dateValidate\LoginData;
use app\admin\includefile\Basedata;
use app\common\module\Article;
use app\common\module\ArticleInfo;
use app\common\module\ArticleKeywordRelation;
use app\common\module\Category;
use app\common\module\Keywords;
use app\common\module\User;
use app\service\ArticleService;
use app\service\BaseController;
use think\Cookie;
use think\Db;
use think\Exception;
use think\Hook;
use think\Request;
use think\Session;

class Module extends BaseController
{
    //登录页面处理
    public function loginHandle()
    {
        Hook::listen('isAjax');//钩子--检查是ajax提交
        $loginInfo = input();
        //数据校验
        $validate = new LoginData();
        if ( !$validate->check($loginInfo) ) {
            $this->error('登录失败' . $validate->getError());
        }
        //获取该用户信息
        $user = User::get([ 'username' => $loginInfo['username'] ]);
        //如果没有该用户
        if ( !$user ) {
            $this->error('登录失败，请输入正确的账户名');
        }
        //保存登录用户的cookie
        Cookie::set('user', $loginInfo['username']);
        //判断是否是第二次登录
        if ( Cookie::has('loginUser') ) {//---是第二次  则判断验证码
            if ( !captcha_check($loginInfo['captcha']) ) {
                $this->error('登录失败，请输入正确的验证码');
            }
        }
        if ( md5($loginInfo['password'] . $user->salt) !== $user->password || !$user->status ) {
            Cookie::set('loginUser', $loginInfo['username']);
            $this->error('登录失败，账户名密码不匹配或你没有该权限');
        }
        session('user', $user->id);
        $this->success('登录成功', '', '/admin/module/index');
    }
    
    //后台首页初始化
    public function indexInit()
    {
        Hook::listen('login');//钩子--检查是否登录
        Hook::listen('isAjax');//钩子--检查是ajax提交
        $user = new User();
        $user = $user->where('id', Session::get('user'))->column('username,id,status');
        echo json_encode([ 'data' => array_values($user)[0] ]);
    }
    
    #用户管理
    public function cp_user()
    {
        Hook::listen('login');//钩子--检查是否登录
        $this->assign([ 'list' => Db::name('user')
            ->where('status', '>', 0)
            ->paginate(3) ]);
        return $this->fetch();
    }
    
    //用户删除
    public function delUser()
    {
        Hook::listen('login');//钩子--检查是否登录
        $id = input('id');
        $user = User::get($id);
        $user->status = 0;
        $user->save();
        $this->success('删除成功', 'module/cp_user');
    }
    
    //【发布文章初始化】
    public function cp_article_edit()
    {
        Hook::listen('login');//钩子--检查是否登录
        return $this->fetch();
    }
    
    //发布文章处理
    public function addArticleHandle()
    {
        Hook::listen('login');//钩子--检查是否登录
        Hook::listen('isAjax');//钩子--检查是ajax提交
        $data = Request::instance()->post();//
        $data['create_time'] = date("Y-m-d H:i:s", time());
        $data['thumb_url'] = $this->imgUpload('add');
        //数据验证
        $validate = new ArticleData();
        if ( !$validate->check($data) ) {
            $this->error('操作失败' . $validate->getError());
        }
        //开启事务
        Db::startTrans();
        try {
            //判断状态
            $data['status'] = $data['opeate'] == "立即发布" ? 1 : 0;
            //----插入文章 主表
            $article = new Article();
            //过滤非表字段数据，然后插入数据+判断是否插入成功
            if ( !$article->allowField(true)->save($data) ) {
                throw new Exception($article->getError());
            }
            //---副表  ArticleInfo-插入aid+content
            $articleInfo = new ArticleInfo();
            $articleInfo->aid = $article->id;//aid 字段赋值
            $articleInfo->content = $article->content;//content 字段赋值
            //然后插入数据+判断是否插入成功
            if ( !$articleInfo->save() ) {
                throw new Exception($articleInfo->getError());
            }
            //--自增文章数量-------栏目表字段total_rows-
            Db::name('category')->where('id', $data['category_id'])->setInc('total_rows');
            //处理关键字 -》 判断有没有该关键字--没有-则追加在关键字表中  有 --则在文章、关键字关系表中加上该关键字和文章的关系
            
            ArticleService::addKeyword($articleInfo->aid, $data['keyword']);
            Db::commit();
            $this->success('发布成功');
        } catch ( Exception $e ) {
            Db::rollback();
            $this->error($e->getMessage());
        }
    }
    
    //【图片上传处理----返回图片保存路径】
    private function imgUpload( $ope = 'edit' )
    {
        //获取表单上传的文件
        $file = request()->file('thumb');
        //判断是否上传文件
        if ( $ope == 'add' && empty($file) ) {//发布文章
            $this->error('请上传封面图片');
        }
        //如果修改时没有上传图片----直接返回false----否则返回处理后的图片路径
        if ( $ope == 'edit' && empty($file) ) {
            return false;
        }
        //判断是否是图片
        $checkImg = $file->validate([ 'imgRule' => 'jpg,png,gif,jpeg' ])->check();
        if ( !$checkImg ) {
            $this->error('请上传封面图片,包含格式jpg,png,gif,jpeg');
        }
        //移动到框架应用根目录/public/static/admin/uploads/ 目录下
        $uploads = ROOT_PATH . 'public' . DS . 'static' . DS . 'admin' . DS . 'uploads';
        //$path.$info->getSaveName()
        $info = $file->move($uploads);
        //判断是否上传成功
        if ( $info == false ) {
            exit($file->getError());
        }
      
        $path = DS . $info->getSaveName();
        //dump($uploads.$path);die;
        $image = \think\Image::open($uploads.$path);//将图片裁剪为300x300并保存
        //dump($image);die;
        $image->crop(300, 300)->save($uploads.$path);
        //返回储存路径
        return $path;
    }
    
    //【管理文章模块】
    //------文章列表
    public function cp_article()
    {
        Hook::listen('login');//钩子--检查是否登录
        //通过模型获取文章所有数据
        $articleArr = $this->getArticleArr();
        $this->assign([ 'list' => $articleArr ]);
        return $this->fetch();
    }
    
    //文章筛选模块
    private function getArticleArr()
    {   //调用扩展文件extend\paginate\BackendPage--自定义config文件
        $article = new Article();
        //dump(input());die;
        if ( input('screening_category') ) {//-----------1、栏目筛选
            $category_id = input('screening_category');
            if ( $category_id == 0 ) {
                $articleArr = $article->paginate(3);
            }
            else { //调用扩展文件extend\paginate\BackendPage--自定义config文件
                $articleArr = $article->where('category_id', $category_id)->paginate(3);
            }
        }
        else if ( input('screening_order') ) {//----------2、时间筛选
            $order = input('screening_order');
            switch ( $order ) {
                case 'time-desc':
                    $order = 'create_time';
                    $value = 'desc';
                    break;
                case 'time-asc':
                    $order = 'create_time';
                    $value = 'asc';
                    break;
                case 'show-desc':
                    $order = 'status';
                    $value = 'asc';
                    break;
            }
            $articleArr = $article->order($order, $value)->paginate(3);
        }
        else if ( input('keyword_search') ) {//-----------3、关键字筛选
            $keyword = input('keyword_search');
            //找到当前关键字id
            $keyword = Keywords::get([ 'keyword' => $keyword ]);
            //如果没有该关键字--直接返回空数组
            if ( empty($keyword) ) {
                $articleArr = $article->where('id', -1)->paginate(3);
            }
            $articleArr = $keyword->article()->paginate(3);
        }
        else {//--------所有数据----默认时间降序
            $articleArr = $article->order('create_time', 'desc')->paginate(3);
        }
        return $articleArr;
    }
    //-----【-----编辑模块
    //-----------编辑文章初始化
    public function cp_article_edit_2()
    {
        Hook::listen('login');//钩子--检查是否登录
        $article = Article::get(input('id'));
        $this->assign([ 'art' => $article ]);
        //得到当前文章所属栏目id
        $art = Article::find(input('id'));
        $id = $art->category->id;
        $this->assign([ 'colId' => $id ]);
        return $this->fetch();
    }
    
    //-----------编辑文章提交之后处理
    public function editHandle()
    {
        Hook::listen('login');//钩子--检查是否登录
        Hook::listen('isAjax');//钩子--检查是ajax提交
        $data = Request::instance()->post();
        $data['update_time'] = date("Y-m-d H:i:s", time());
        if ( $this->imgUpload('edit') ) {
            $data['thumb_url'] = $this->imgUpload('edit');
        }
        //数据验证
        $validate = new ArticleData();
        if ( !$validate->check($data) ) {
            $this->error('操作失败' . $validate->getError());
        }
        //开启事务
        Db::startTrans();
        try {
            //判断状态
            $data['status'] = $data['opeate'] == "立即发布" ? 1 : 0;
            //----插入文章 主表
            $article = new Article();
            //过滤非表字段数据，然后插入数据
            $article->allowField(true)->save($data, [ 'id' => $data['id'] ]);
            //---副表  ArticleInfo-更新aid+content
            $articleInfo = ArticleInfo::get($data['id']);
            //然后更新文章内容
            $articleInfo->content = $data['content'];
            $articleInfo->save();
            //处理关键字 修改或者增加-》
            ArticleService::updaKeyword($articleInfo->aid, $data['keyword']);
            Db::commit();
            $this->success('修改成功');
        } catch ( Exception $e ) {
            Db::rollback();
            $this->error('修改失败' . $e->getMessage());
        }
    }
    
    #【栏目】
    public function cp_category()
    {
        Hook::listen('login');//钩子--检查是否登录
        $arr = ( new \app\admin\widget\Category() )->getColArr();//获取栏目数组---二维
        $arr = $this->getListHtml($arr);
        $this->assign([ 'list' => $arr ]);
        return $this->fetch();
    }
    
    //添加栏目
    public function addCategory()
    {
        Hook::listen('login');//钩子--检查是否登录
        $cateArr = input()['add'];
        if ( !$cateArr ) {//没有添加则
            $this->error('添加失败，请重新添加(3秒后返回上一页)');
        }
        foreach ( $cateArr as $k => $v ) {
            if ( !$v )
                break;
            $cateArr[$k]['create_time'] = time();
        }
        if ( !$category = new Category($cateArr) ) {
            $this->error('添加失败，请重新添加(3秒后返回上一页)');
        }
        $category->allowField(true)->saveAll($cateArr);
        $this->success('添加成功', 'module/cp_category');
    }
    
    //删除栏目----category()
    public function delCategory()
    {
        Hook::listen('login');//钩子--检查是否登录
        $id = input('id');
        $cateArr = Category::get([ 'id' => $id ]);
        if ( $cateArr->total_rows > 0 ) {
            $this->error('删除失败，该栏目存在其他文章(3秒后返回上一页)');
        }
        Category::destroy($id);
        $this->success('删除成功', 'module/cp_category', [ 'pid' => $cateArr['parent_id'] ]);
    }
    
    //编辑栏目页面
    public function cp_category_edit()
    {
        Hook::listen('login');//钩子--检查是否登录
        $category = Category::get(input('id'));
        $this->assign([ 'category' => $category, 'pid' => $category['parent_id']
        ]);
        return $this->fetch();
    }
    
    //栏目编辑后处理
    public function altCategory()
    {
        Hook::listen('login');//钩子--检查是否登录
        $data = input();
        $category = new Category();
        $res = $category->allowField(true)->save($data, [ 'id' => $data['oldId'] ]);
        if ( !$res ) {
            $this->error('修改失败');
        }
        $this->success('修改成功', 'module/cp_category');
    }
    
    //得到所有栏目拼接的 html
    private function getListHtml( $arr, $level = 0 )
    {
        $html = '';
        foreach ( $arr as $key => $val ) {
            if ( array_key_exists('_child', $val) ) {
                $html .= "<tr class = 'hover' >
                            <td class = 'center'>
                              <input type = 'text' class = 's-num' name = 'save[" . $val['parent_id'] . "][" . $val['id'] . "]' value = '" . $val['sort'] . "'>
                            </td>
                            <td>
                                <input type = 'text' name = 'save[" . $val['parent_id'] . "][" . $val['id'] . "]' value = '" . $val['category_name'] . "'>
                            </td>
                            <td class = 'center'>
                                <a href = '/admin/module/cp_category_edit/id/" . $val['id'] . ".html' class='jq-cp-edit' data-id='" . $val['id'] . "'>编辑</a>
                                <a href = '#' class = 'jq-del' data-id='" . $val['id'] . "'>删除</a>
                            </td>
                        </tr>";
                $html .= $this->getListHtml($val['_child'], $level + 1);
                $html .= "<tr>
                            <td colspan='3'>
                                <i class='icon-sub-add'></i>
                                <span class='jq-sub-add s-add'  data-id='" . $val['id'] . "'>
                                <i class='icon-cross' ></i><b >添加子栏目</b>
                                </span>
                            </td>
                        </tr>";
            }
            else {
                for ( $i = 0; $i < $level; $i++ ) {
                    $html .= "<tr class='hover'>
                                <td class='center'>
                                   <input type='text' class='s-num' name='save[" . $val['parent_id'] . "][" . $val['id'] . "]' value='" . $val['sort'] . "'>
                                </td>
                                <td>
                                    <i class='icon-sub'></i>
                                    <input type='text' name='save[" . $val['parent_id'] . "][" . $val['id'] . "]' value='" . $val['category_name'] . "'>
                                </td>
                                <td class='center'>
                                    <a href='/admin/module/cp_category_edit/id/" . $val['id'] . ".html' class='jq-cp-edit' data-id='" . $val['id'] . "'>编辑</a>
                                    <a href='#' class='jq-del' data-id='" . $val['id'] . "'>删除</a>
                                </td>
                            </tr>";
                }
                if ( $level == 0 ) {
                    $html .= "<tr class = 'hover'>
                            <td class = 'center'>
                                <input type = 'text' class = 's-num' name = 'save[" . $val['parent_id'] . "][" . $val['id'] . "]' value = '" . $val['sort'] . "'>
                            </td>
                            <td>
                                <input type = 'text' name = 'save[" . $val['parent_id'] . "][" . $val['id'] . "]' value = '" . $val['category_name'] . "'>
                            </td>
                            <td class = 'center'>
                                <a href = '/admin/module/cp_category_edit/id/" . $val['id'] . ".html' class='jq-cp-edit' data-id='" . $val['id'] . "'>编辑</a>
                                <a href = '#' class = 'jq-del'  data-id='" . $val['id'] . "'>删除</a>
                            </td>
                            </tr>
                            <tr>
                                <td colspan='3'>
                                <i class='icon-sub-add'></i>
                                <span class='jq-sub-add s-add' data-id='" . $val['id'] . "'>
                                <i class='icon-cross' ></i><b  >添加子栏目</b>
                                </span>
                                </td>
                            </tr>";
                }
            }
        }
        return $html;
    }
    
    #【文章软删除】
    public function delArticle()
    {
        Hook::listen('login');//钩子--检查是否登录
        $id = input('id');
        //软删除该文章
        $res = Article::destroy($id);
        if ( $res ) {
            //递减该栏目文章数量
            Db::name('category')->where('id', $id)->setDec('total_rows');
            $this->success('删除成功', 'module/cp_article');
        }
        $this->error('删除失败');
    }
    
    #数据库字典
    public function basedata()
    {
        Hook::listen('login');//钩子--检查是否登录
        $config = [ // 服务器地址
        'hostname' => '127.0.0.1', // 数据库名
        'database' => 'tpcms', // 用户名
        'username' => 'root', // 密码
        'password' => 'root',
        ];
        $UtilDbdic = new Basedata();
        return $UtilDbdic->export_dict($config)->table()->html();
    }
    
    #后台首页
    public function cp_index()
    {
        Hook::listen('login');//钩子--检查是否登录
        return $this->fetch();
    }
    
    #登录首页
    public function index()
    {
        Hook::listen('login');//钩子--检查是否登录
        return $this->fetch();
    }
}