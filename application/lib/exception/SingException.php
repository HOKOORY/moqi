<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/29
 * Time: 14:55
 */

namespace app\lib\exception;


class SingException extends BaseException {
    public $code = 400;
    public $msg = '此歌曲没被删除';
    public $errorCode = 70000;
}