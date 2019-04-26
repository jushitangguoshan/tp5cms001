<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/22
 * Time: 9:17
 */

return [
  'app_id' => 'wx9d25bb982327bde5',
  'app_secret' => 'b0ffa3add1b8d6108854f6e7be2a84e2',
  'login_url'=> "https://api.weixin.qq.com/sns/jscode2session?" .
      "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
  'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
      "grant_type=client_credential&appid=%s&secret=%s",

];