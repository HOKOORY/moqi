<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/19
 * Time: 13:15
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException {
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}