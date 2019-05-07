<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 10:30
 */

namespace app\lib\exception;


class ParameterException extends BaseException {
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}