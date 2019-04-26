<?php

define("APPID", "wxfe8ad413f360dc9a");
define('APPSECRET', "842bc5bfc0aef27499d36717e8a0fbaf");
if( isset($_GET[ 'echostr' ]) ){
    //配置连接微信服务
    echoStr();
}
else if( isset($_GET[ 'code' ]) ){
    //授权
    authorization();
}
else{
    //获取用户的xml数据包进行处理
    scanning();
}
//扫描之后
function scanning()
{   //扫描之后
    //fileStyle();存文件方式
    databaseStyle();//数据库方式
}
//授权处理
function authorization()
{
    //拉起授权
    $code = $_GET[ 'code' ];
    //使用code换取access_token、openid
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=$code&grant_type=authorization_code";
    $res = https_request($url);
    $res = json_decode($res, true);
    $access_token = $res[ 'access_token' ];
    $openid = $res[ 'openid' ];
    $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";
    //获取用户信息
    $res = https_request($url);
    $res = json_decode($res, true);
    echo "<pre>";
    print_r($res);
    echo "</pre>";
    //authorizeReply($res);
}
//回复用户授权信息
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

//连接数据库
function mysqlLink(){
    $dbhost = 'sqld-gz.bcehost.com';
    $dbuser = 'ca3a0c72c0d14d02960577145c3d0afc';
    $dbpass = 'fd11bb6cd7a44fbb9715029b7b66687b';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if( !$conn ){
        die('Could not connect: '.mysqli_error());
    }
    return $conn;
}
/*
 * 数据库方式
 *
 */
function databaseStyle(){
    $xmlData = $GLOBALS['HTTP_RAW_POST_DATA'];
    $data = simplexml_load_string($xmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
    $data = json_decode(json_encode($data));
    file_put_contents('qqqqq.txt',$data,FILE_APPEND);
//    switch($data['']){
//
//    }
}






/*
 * 存文件方式显示二维码
*/
function fileStyle()
{
    if( isset($GLOBALS[ 'HTTP_RAW_POST_DATA' ]) ){
        $arr = fileSaveXmlMsg();//保存用户过来的xml数据
        handle($arr);//扫码之后
    }
    //第一次初始化界面
    else if( isset($_GET[ 'ope' ]) && $_GET[ 'ope' ] == 'init' ){
        //初始化显示界面
        $count = file_get_contents('count.txt');
        if( !$count ){
            //初始化数据
            $count = [ [ 'id' => 2, 'num' => 0, 'name' => 'kk' ], [ 'id' => 4, 'num' => 0, 'name' => 'jj' ], [ 'id' => 6, 'num' => 0, 'name' => 'pp' ] ];
            file_put_contents('count.txt', serialize($count));
        }
        showHtml();
    }
    //定时刷新
    else if( isset($_GET[ 'ope' ]) && $_GET[ 'ope' ] == 'up' ){
        $data = unserialize(file_get_contents('htmls.txt'));
        echo json_encode([ 'data' => $data ]);
    }
}
//保存事件的xml参数
function fileSaveXmlMsg()
{
    $postXmlData = $GLOBALS[ 'HTTP_RAW_POST_DATA' ];
    //将xml转换为array
    $obj = simplexml_load_string($postXmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
    $arr = json_decode(json_encode($obj), true);
    //存文件查看
    file_put_contents('gaunzhu.txt', serialize($arr));
    return $arr;
}
function handle( $arr )
{
    if( !empty($arr) ){
        if( !isset($_GET[ 'code' ]) ){
            //拉起授权页面
            $redirect_uri = urlencode("http://www.anniluohaixing.xyz/wechat/wechatConnect.php");
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
            reply($url);
        }
        //事件处理
        eventHandle();
        //刷新数据
        showHtml();
    }
}
//授权成功后回复
function authorizeReply( $data )
{
    //    $appUser = unserialize(file_get_contents('gaunzhu.txt'));
    //    $temp = "<xml>
    //              <ToUserName><![CDATA[%s]]></ToUserName>
    //              <FromUserName><![CDATA[%s]]></FromUserName>
    //              <CreateTime>%s</CreateTime>
    //              <MsgType><![CDATA[text]]></MsgType>
    //              <Content><![CDATA[%s]]></Content>
    //            </xml>";
    //   //var_dump($data);
    //    echo sprintf($temp, $appUser[ 'FromUserName' ], $appUser[ 'ToUserName' ], time(), "客官".$data['nickname']."，你已经成功托管");
}
//关注事件处理
function eventHandle()
{
    $data = unserialize(file_get_contents('gaunzhu.txt'));
    switch( $data[ 'Event' ] ){
        case 'subscribe':
            //关注后
            addUser($data);
            break;
        case 'SCAN':
            //扫描后
            scan($data);
            break;
        case 'unsubscribe':
            //取消关注后
            delUser($data);
            break;
    }
}
//扫描后---已关注用户
function scan( $data )
{
    //回复文本s
    $temp = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>";
    echo sprintf($temp, $data[ 'FromUserName' ], $data[ 'ToUserName' ], time(), '元芳你已经关注了');
}
//关注后
function addUser( $data )
{
    $count = unserialize(file_get_contents('count.txt'));
    foreach( $count as $key => $value ){
        if( 'qrscene_'.$value[ 'id' ] == $data[ 'EventKey' ] ){
            $count[ $key ][ 'num' ] += 1;
            break;
        }
    }
    saveUser($data);
    file_put_contents('count.txt', serialize($count));
}
function saveUser( $data )
{
    $user = unserialize(file_get_contents('user.txt'));
    if( !$user ){
        $user = [];
    }
    $user[ $data[ 'FromUserName' ] ] = [ 'user' => $data[ 'FromUserName' ], 'mark' => $data[ 'EventKey' ] ];
    file_put_contents('user.txt', serialize($user));
    //回复文本s
    $temp = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>";
    echo sprintf($temp, $data[ 'FromUserName' ], $data[ 'ToUserName' ], time(), '客官，你关注了我哦，里边请');
}
//取消关注后
function delUser( $data )
{
    $count = unserialize(file_get_contents('count.txt'));
    $user = unserialize(file_get_contents('user.txt'));
    foreach( $count as $key => $value ){
        if( 'qrscene_'.$value[ 'id' ] == $user[ $data[ 'FromUserName' ] ][ 'mark' ] ){
            $count[ $key ][ 'num' ] -= 1;
            break;
        }
    }
    unset($user[ $data[ 'FromUserName' ] ]);
    file_put_contents('user.txt', serialize($user));
    file_put_contents('count.txt', serialize($count));
}
//刷新渲染
function showHtml()
{
    $arr = unserialize(file_get_contents('count.txt'));
    $data = [];
    foreach( $arr as $key => $value ){
        $url = getMyCode($value[ 'id' ]);
        $data[] = [ 'name' => $value[ 'name' ], 'num' => $value[ 'num' ], 'img' => $url ];
    }
    file_put_contents('htmls.txt', serialize($data));
    echo json_encode([ 'data' => $data ]);
}
//获取img的url
function getMyCode( $num )
{
    $info = getJsoninfo();
    $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$info[ 'access_token' ];
    $pram = '{
                "expire_seconds": 604800,
                "action_name": "QR_SCENE",
                "action_info":
                    {
                    "scene":
                        {
                            "scene_id" : '.$num.',
                            "scene_str": "'.$num.'"
                        }
                    }
            }';
    $output = https_request($url, $pram);
    $output = json_decode($output, true);
    $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($output[ 'ticket' ]);
    return $url;
}
//get access_token(json)
function getJsoninfo()
{
    $jsoninfo = file_exists('access_token.txt');
    if( !$jsoninfo ){//判断access_token 是否存在 ---不存在进入
        $jsoninfo = saveAccessToken();
    }
    else{
        $jsoninfo = unserialize(file_get_contents('access_token.txt'));
        if( ( time() - $jsoninfo[ 'time' ] ) > $jsoninfo[ 'expires_in' ] ){//判断access_token是否失效，--失效进入
            $jsoninfo = saveAccessToken();
        }
    }
    return $jsoninfo;
}
//sava--access_token
function saveAccessToken()
{
    $appID = "wxfe8ad413f360dc9a";
    $appsecret = "842bc5bfc0aef27499d36717e8a0fbaf";
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appID&secret=$appsecret";
    $output = https_request($url);
    $output = json_decode($output, true);
    $output[ 'time' ] = time();
    file_put_contents('access_token.txt', serialize($output));
    return $output;
}
//握手api地址
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
    return $output;
}
//请求微信服务
function echoStr()
{
    //get参数
    $signtrue = $_GET[ 'signature' ];
    $timestamp = $_GET[ 'timestamp' ];
    $nonce = $_GET[ 'nonce' ];
    $echostr = $_GET[ 'echostr' ];
    $myToken = 'jstgs';
    $arr = [ $myToken, $timestamp, $nonce ];
    sort($arr, SORT_STRING);
    $arrStr = implode($arr);
    $arrStr = sha1($arrStr);
    if( $signtrue == $arrStr ){
        echo $echostr;
    }
}


