<?php
/**
 * Created by 巨石糖果山.
 * User: 1034610091@qq.com
 * Date:2019/4/4 0004 / 下午 2:55
 */

namespace app\admin\widget;

class RoleSelect
{
    public function showRoleSelect()
    {
        $html = <<<POL
         <div class="layui-input-block">
            <select name="interest" lay-filter="aihao">
                <option value=""></option>
                  %s
            </select>
        </div>
POL;

    }
}