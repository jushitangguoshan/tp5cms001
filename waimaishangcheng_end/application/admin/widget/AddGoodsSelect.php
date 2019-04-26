<?php
/**
 * Created by PhpStorm.
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/4 0004
 * Time: 上午 9:20
 */

namespace app\admin\widget;

use app\common\model\Category;

class AddGoodsSelect
{
    public function show()
    {
        $html = <<<SELECT
        <div class="layui-form-item">
                <label class="layui-form-label">所属店铺</label>
                <div class="layui-input-block">
                    <select name="belong_store_id" lay-verify="required" id="shop">
                        <option value="">选择所属店铺</option>
                        %s
                    </select>
                </div>
            </div>   
SELECT;
        $shopModel = new \app\common\model\Shop();
        $data = $shopModel->where('status',1)->select();
        $option = '';
        foreach($data as $key => $val){
            $option .= "<option value='{$val->id}'>{$val->name}</option>";
        }
        return sprintf($html,$option);
    }
}