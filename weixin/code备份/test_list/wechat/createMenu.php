<?php
require_once "WxApi.php";
class CreateMenu extends WxApi
{
    protected $getAC_TOKEN = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s";
    protected $AC_TOkEN;
    public function __construct(  )
    {
        $this->AC_TOKEN = $this->getAccessToken();
        $this->getAC_TOKEN = sprintf($this->getAC_TOKEN, $this->AC_TOKEN);
    }
    /**生成菜单执行结果
     * @return mixed
     */
    public function getResult( $data)
    {
        return $this->https_request($this->getAC_TOKEN, $data);
    }
}
$jsonmenu = '{
                "button": [
                    {
                        "type": "click",
                        "name": "学园作品",
                        "key": "V1001_TODAY_ZUOPING"
                    },
                    {
                        "type": "click",
                        "name": "能力测试",
                        "key": "V1001_TODAY_ABILITYTOTEST"
                    },
                    {
                        "name": "我的",
                        "sub_button": [
                            {
                                "type": "view",
                                "name": "个人信息",
                                "url": "http://www.anniluohaixing.xyz/wechat/myinfo.php"
                            },
                            {
                                "type": "view",
                                "name": "老师操作111",
                                "url": "http://v.qq.com/"
                            },
                            {
                                "type": "view",
                                "name": "位置",
                                "url": "http://www.anniluohaixing.xyz/wechat/share.php"
                            },
                        ]
                    }
                ]
            }';

//$jsonmenu = [
//    "button" => [
//        [
//            "type" => "click",
//            "name" => "学园作品",
//            "key" => "V1001_TODAY_ZUOPING"
//        ],
//        [
//            "type" => "click",
//            "name" => "能力测试",
//            "key" => "V1001_TODAY_ABILITYTOTEST"
//        ],
//        [
//            "name" => "我的",
//            "sub_button" => [
//                [
//                    "type" => "view",
//                    "name" => "个人信息",
//                    "url" => "http://www.anniluohaixing.xyz/wechat/myinfo.php"
//                ],
//                [
//                    "type" => "view",
//                    "name" => "老师操作111",
//                    "url" => "http://v.qq.com/"
//                ],
//                [
//                    "type" => "view",
//                    "name" => "我的位置",
//                    "url" => "http://www.anniluohaixing.xyz/wechat/share.php"
//                ]
//            ]
//        ]
//    ]];

$createMenu = new CreateMenu();
$res = $createMenu->getResult($jsonmenu);
var_dump($res);
/*
 $access_token=(new WxApi())->getAccessToken();
//////自定义菜单请求地址
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$jsonmenu = '{
                "button": [
                    {
                        "type": "click",
                        "name": "学园作品",
                        "key": "V1001_TODAY_ZUOPING"
                    },
                    {
                        "type": "click",
                        "name": "能力测试",
                        "key": "V1001_TODAY_ABILITYTOTEST"
                    },
                    {
                        "name": "我的",
                        "sub_button": [
                            {
                                "type": "view",
                                "name": "个人信息",
                                "url": "http://www.anniluohaixing.xyz/wechat/myinfo.php"
                            },
                            {
                                "type": "view",
                                "name": "老师操作111",
                                "url": "http://v.qq.com/"
                            },
                            {
                                "type": "view",
                                "name": "位置",
                                "url": "http://www.anniluohaixing.xyz/wechat/share.php"
                            },
                        ]
                    }
                ]
            }';
$res= (new WxApi())->https_request($url,$jsonmenu);
var_dump($res);
*/