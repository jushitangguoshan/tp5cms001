<?php
/**
 * Created by PhpStorm.
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/6 0006
 * Time: 下午 8:44
 */

namespace app\admin\widget;


use app\common\model\Category;

class CategorySelect
{
    public function show()
    {
        $html = <<<SELECT
        <div class="layui-form-item">
                <label class="layui-form-label">商品分类</label>
                <div class="layui-input-block">
                    <select name="belong_category_id" lay-verify="required" id="category">
                        <option value="">选择商品分类</option>
                        %s
                    </select>
                </div>
            </div>
SELECT;
        $categoryModel = new Category();
        $dataTwo = $categoryModel->where('status',1)->select();
        $content = '';
        foreach($dataTwo as $key => $val){
            $content .= "<option value='{$val->id}'>{$val->category_name}</option>";
        }
        return sprintf($html,$content);
    }
}