<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/15
 * Time: 16:23
 */

namespace app\lib\exception;


class WeChatException extends BaseException {
    public $code = '400';
    public $msg =  '微信服务器接口调用失败';
    public $errorCode = 999;
}