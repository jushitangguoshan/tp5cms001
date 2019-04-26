<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/7 0007
     * Time: 上午 10:24
     */
    return [
        'paginate'=>[
            'type'      => '\paginate\BackendPage',
            'var_page'  => 'page',
            'list_rows' => 15],
        'template' => [
            'layout_on' => true,//开启模板布局
            'layout_name' => 'layout'
            ]
    ];

