<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 14:47
 */

namespace app\lib\exception;


class CodeException extends BaseException {
    public $code = '401';
    public $msg = 'code已过期或者失效code';
    public $errorCode = 10002;
}