<?php
/**
 * 微信api
 * User: Jack<376927050@qq.com>
 * Date: 2019/3/16
 * Time: 15:47
 */


class WxApi
{
    private static $_appId = 'wxfe8ad413f360dc9a';
    private static $_appSecret = '842bc5bfc0aef27499d36717e8a0fbaf';
    protected static $cacheFile = 'token.txt';
    protected static $cacheExpireTime = 7000;
    // 获取访问令牌API
    protected static $getTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
    // 获取二维码
    protected static $getQrcodeUrl = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s';

    /*
     * 获取调用各个接口所需的访问令牌
     * @return mixed
     */
    public function getAccessToken()
    {
        if( file_exists(self::$cacheFile) ){
            $fileCreateTime = filectime(self::$cacheFile);
            if( time() - $fileCreateTime < self::$cacheExpireTime ){
                $fileContent = file_get_contents(self::$cacheFile);
                $data = json_decode($fileContent,true);
                return $data['access_token'];
            }
        }
        return $this->requestApiGetAccessToken(self::$_appId,self::$_appSecret);
    }

    /**
     * 请求token
     * @param $appid
     * @param $appsecret
     * @return mixed
     * @throws Exception
     */
    protected function requestApiGetAccessToken($appid,$appsecret)
    {
        $request_url = sprintf(self::$getTokenUrl,$appid,$appsecret);
        $result = $this->https_request($request_url);
        file_put_contents(self::$cacheFile,$result);
        $arrData = json_decode($result,true);
        return $arrData['access_token'];
    }

    /**
     * http请求方法
     * @param $url
     * @param null $data
     * @return mixed
     */
    public function https_request($url,$data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    /**
     * @param $url
     * @param $filestring
     * @return bool|string
     */
    public function downLoadQr($url,$filestring){
        if($url == ""){
            return false;
        }
        $filename = $filestring.'.jpg';
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
        $size=strlen($img);
        $fp2=fopen($filename,"a");
        if(fwrite($fp2,$img) === false){
            return '';
        }
        fclose($fp2);
        return $filename;
    }
//    /**
//     * @param $loginfo
//     */
//    public function log($loginfo)
//    {
//        date_default_timezone_set('Asia/Shanghai');
//        $loginfo = date('Y-m-d H:i:s',time()) . $loginfo . PHP_EOL;
//        file_put_contents('err.log',$loginfo,FILE_APPEND);
//    }

}