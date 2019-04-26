<?php
define("APPID","wxfe8ad413f360dc9a");
define('APPSECRET',"842bc5bfc0aef27499d36717e8a0fbaf");
$appid = "wxfe8ad413f360dc9a";
$appsecret="842bc5bfc0aef27499d36717e8a0fbaf";
authorizePage($appid,$appsecret);
function authorizePage($appid,$appsecret){
    if(!isset($_GET['code'])){
        //拉起授权页面
        authorize($appid);
    }else{
        //获取code
        $code = $_GET['code'];
        //使用code换取access_token、openid
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $res = https_request($url);
        var_dump($res);die;
        $access_token=$res['access_token'];
        $openid=$res['openid'];
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";
        //获取用户信息s
        $res = https_request($url);
        echo "<pre>";
        print_r($res);
        echo "</pre>";
    }
}

//拉起授权页面
function authorize($appid){
    $redirect_uri = urlencode("http://www.anniluohaixing.xyz/wechat/userinfo.php");
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
    reply($url);
}
//授权回复用户消息
function reply($url){
    $postXmlData = $GLOBALS['HTTP_RAW_POST_DATA'];
    $obj = simplexml_load_string($postXmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
    $data = json_decode(json_encode($obj), true);
    //回复文本s
    $temp = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>";
    echo sprintf($temp, $data[ 'FromUserName' ], $data[ 'ToUserName' ], time(), "<a href='".$url."'>点击进去授权</a>");
}


//握手api
function https_request( $url, $data = null )
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
    return json_decode($output,true);
}