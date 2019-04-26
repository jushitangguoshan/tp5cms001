<?php
guanzhu();
function guanzhu()
{
    $link = myLink();
    //扫描之后
    if( isset($GLOBALS[ 'HTTP_RAW_POST_DATA' ]) ){
        handle();
    }
    else if( isset($_GET[ 'ope' ])){
        //初始化显示界面
        $count = mysqli_query($link, "select * from code_count");
        if( !$count || mysqli_affected_rows($link)<1){
            //初始化数据
            $count = [ [ 'id' => 2, 'num' => 0, 'name' => 'kk' ], [ 'id' => 4, 'num' => 0, 'name' => 'jj' ], [ 'id' => 6, 'num' => 0, 'name' => 'pp' ] ];
            //插入数据
            insertData($link,$count,"code_count");
        }
        //定时刷新
        showHtml();
    }
    
}
//扫码后处理
function handle()
{
    $postXmlData = $GLOBALS[ 'HTTP_RAW_POST_DATA' ];
    //将xml转换为array
    $obj = simplexml_load_string($postXmlData, 'SimpleXMLElement', LIBXML_NOCDATA);
    $arr = json_decode(json_encode($obj), true);
    if( !empty($arr) ){
        
        //事件处理
        eventHandle($arr);
        //刷新数据
        showHtml();
    }
}
//xml参数处理
function eventHandle($data)
{
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
//新用户关注后
function addUser( $data )
{
    $link = myLink();
    $res = mysqli_query($link,'select `id` from  `code_count`');
    $count = mysqli_fetch_all($res,MYSQLI_ASSOC);
    foreach( $count as $key => $value ){
        if( 'qrscene_'.$value[ 'id' ] == $data[ 'EventKey' ] ){
            mysqli_query($link,"update `code_count` set `num`=".($value['num']+1)." where `id`=".$value['id']);
            break;
        }
    }
    
    saveUser($data);
}
function saveUser( $data )
{
    $link = myLink();
    $sql = "insert into `code_users`(`name`,`mark`) values('".$data['FromUserName']."','".$data[ 'EventKey' ]."')";
    $res = mysqli_query($link,$sql);
    if($res){
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
}
//取消关注后
function delUser( $data )
{
    $link = myLink();
    $res = mysqli_query($link,'select `id` from  `code_count`');
    $count = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $res = mysqli_query($link,'select * from  `code_users`');
    $user = mysqli_fetch_all($res,MYSQLI_ASSOC);
    foreach( $count as $key => $value ){
        if( 'qrscene_'.$value[ 'id' ] == $user[ 'mark' ] && $value['num']>0){
            mysqli_query($link,"update `code_count` set `num`=".($value['num']-1)." where `id`=".$value['id']);
            file_put_contents('upde.txt',"update `code_count` set `num`='".($value['num']-1)."' where `id`='".$value['id']."'");
            break;
        }
    }
    mysqli_query($link,"delete from `code_users` where `name`='".$data['FromUserName']."'");
}

//拼接html
function showHtml()
{
    $link = myLink();
    $arr=mysqli_query($link,"select * from code_count");
    $img=getMyCode();//获取图片url;
    $data = [];
    foreach( $arr as $key => $value ){
        $data[] = [ 'name' => $value[ 'name' ], 'num' => $value[ 'num' ], 'img' => $img ];
    }
    echo json_encode([ 'data' => $data ]);
}

//获取img的url
function getMyCode()
{
    $info = getJsoninfo();
    if( !file_exists('img.txt') ){//做二维码失效处理
        getImgUrl($info);
    }
    $url=unserialize(file_get_contents('img.txt'));
    return $url;
}
function getImgUrl($info)
{
    $link = myLink();
    $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$info[ 'access_token' ];
    $arr=mysqli_query($link,"select * from code_count");
    $sql = "update `code_count`  set %s";
    $temp=[];
    foreach($arr as $k=>$value){
        $pram = '{
                        "expire_seconds": 604800,
                        "action_name": "QR_SCENE",
                        "action_info":
                            {
                            "scene":
                                {
                                    "scene_id" : '.$value['id'].',
                                    "scene_str": "'.$value['id'].'"
                                }
                            }
                    }';
        $output = https_request($url, $pram);
        $output = json_decode($output, true);
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($output[ 'ticket' ]);
        $temp[]=$url;
    }
    
}
/*
 * 获取json数据-----access-token
 */
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
//保存access-token
function saveAccessToken()
{
    $appID = "wxfe8ad413f360dc9a";
    $appsecret = "842bc5bfc0aef27499d36717e8a0fbaf";
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appID."&secret=".$appsecret;
    $output = https_request($url);
    $output = json_decode($output, true);
    $output[ 'time' ] = time();
    file_put_contents('access_token.txt', serialize($output));
    return $output;
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
    return $output;
}
//首次请求服务
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


//批量插入数据
function insertData($link,array $count,$tableName){
    $field = [];
    $values = [];
    foreach( $count as $k => $v ){
        $temp =[];
        foreach($v as $key=>$value){
            $field[]='`'.$key.'`';
            $temp[]="'".$value."'";
        }
        $str = '(' .implode(',',$temp).')';
        $values[]=$str;
    }
    $sql = "insert into ".$tableName."(".implode(',',array_unique($field)).") values".implode(',',$values);
    mysqli_query($link, $sql);
}
//连接数据库
function myLink()
{
    $dbhost = 'sqld-gz.bcehost.com';
    $dbuser = 'ca3a0c72c0d14d02960577145c3d0afc';
    $dbpass = 'fd11bb6cd7a44fbb9715029b7b66687b';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if( !$conn ){
        die('Could not connect: '.mysqli_error());
    }
    return $conn;
}