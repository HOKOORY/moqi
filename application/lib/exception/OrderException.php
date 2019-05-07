<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/04/02
 * Time: 10:42
 */

namespace app\lib\exception;


class OrderException extends BaseException {
    public $code = 400;
    public $msg = '订单异常';
    public $errorCode = 70000;
}