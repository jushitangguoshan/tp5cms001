<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/6 0006
     * Time: 下午 2:31
     */

    namespace app\admin\dateValidate;
    use think\Validate;
    class ArticleData extends Validate
    {
        protected $rule = [
        'title' => 'require|max:25',
        'category_id' => 'require',
        ];
        protected $msg = [
        'title.require' => '标题不能为空',
        'title.max' => '名称最多不能超过25个字符',
        'category_id.require' => '栏目不能为空',
        ];
    }