<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 09:33
 */

namespace app\lib\exception;


class UserException extends BaseException {
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}