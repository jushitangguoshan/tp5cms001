<?php
require_once "WxApi.php";
$appid = "wxfe8ad413f360dc9a";
$appsecret = "842bc5bfc0aef27499d36717e8a0fbaf";
if( !isset($_GET[ 'code' ]) ){
    //拉起授权页面
    authorize($appid);
}
else{
    //获取code
    $code = $_GET[ 'code' ];
    //使用code换取access_token、openid
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
    $res = ( new WxApi() )->https_request($url);
    $res = json_decode($res, true);
    $access_token = $res[ 'access_token' ];
    $openid = $res[ 'openid' ];
    $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
    //获取用户信息
    $res = ( new WxApi() )->https_request($url);
    $res=json_decode($res, true);
    include "showMyinfo.php";
}
//拉起授权页面
function authorize( $appid )
{
    $redirect_uri = urlencode("http://www.anniluohaixing.xyz/wechat/myinfo.php");
    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
    header("location:$url");
    //reply($url);
}
//授权回复用户消息
function reply( $url )
{
    $postXmlData = $GLOBALS[ 'HTTP_RAW_POST_DATA' ];
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