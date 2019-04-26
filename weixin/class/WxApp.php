<?php
/**
 * Class WxApp
 * User: Jack<376927050@qq.com>
 * Date: 2019/3/16
 * Time: 15:58
 */

include_once 'WxApi.php';

class WxApp extends WxApi
{
    protected $token;

    public function __construct()
    {
        $this->token = $this->getAccessToken();
    }

    /**
     * 生成临时数字二维码 10进制位最大的范围不超过4294967295
     * @param $sceneId 临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
     * @param int $expire 二维码有效时间，以秒为单位。 最大不超过2592000（即30天），此字段如果不填，则默认有效期为30秒
     */
    public function createTemporaryQrcodeById($sceneId,$expire = 1800)
    {
        $request_url = sprintf(self::$getQrcodeUrl,$this->token);
        $data = [
            'expire_seconds' => $expire,
            'action_name' => 'QR_SCENE',
            'action_info' => [
                'scene' => ['scene_id' => $sceneId]
            ]
        ];
    }

    /**
     * 生成永久参数二维码
     * @param $sceneStr 字符串类型，长度限制为1到64
     */
    public function createForeverQrcodeByStr($sceneStr)
    {
        $request_url = sprintf(self::$getQrcodeUrl,$this->token);
        $data = [
            'action_name' => 'QR_LIMIT_STR_SCENE',
            'action_info' => [
                'scene' => ['scene_str' => $sceneStr]
            ]
        ];
        $this->log($request_url);
        $result = $this->https_request($request_url,json_encode($data));
        $ret = json_decode($result,true);
        if(!isset($ret['errcode'])){
            return $this->getQrcodeImgByTicket($ret['ticket'],$sceneStr);
        }
        $this->log($result);
    }

    /**
     * 获取二维码图片
     * @param $ticket
     * @return mixed
     */
    public function getQrcodeImgByTicket($ticket,$imgName)
    {
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s';
        $qrUrl = sprintf($url,urlencode($ticket));
        return $this->downLoadQr($qrUrl,$imgName);
    }
}