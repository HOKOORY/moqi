<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 11:29
 */

namespace app\lib\exception;


class TokenException extends BaseException {
    public $code = '401';
    public $msg = 'Token已过期或者失效Token';
    public $errorCode = 10001;
}