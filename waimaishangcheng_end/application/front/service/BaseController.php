<?php
/**
 * Created by PhpStorm.
 * User: fans(2296494141@qq.com)
 * Date: 2019/4/6 0006
 * Time: 下午 2:57
 */

namespace app\front\service;


use think\Controller;

class BaseController extends Controller
{
    /**
     * 封装curl
     * @param $url
     * @param null $data
     * @return mixed
     */
    public function https_request( $url, $data = null )
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if( !empty($data) ){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $arr = json_decode($output,true);
        return $arr;
    }
}