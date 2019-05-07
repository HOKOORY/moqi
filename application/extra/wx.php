<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/15
 * Time: 15:46
 */

return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    // 小程序app_id
    'app_id' => 'wxf86e8e22138c4b02',
    // 小程序app_secret
    'app_secret' => 'c453f2eb2e86a188ea298cb9f65cfd76',

    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",


];