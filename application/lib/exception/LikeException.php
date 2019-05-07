<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/27
 * Time: 10:15
 */

namespace app\lib\exception;


class LikeException extends BaseException {
    public $code = 400;
    public $msg = '重复点赞';
    public $errorCode = 50000;
}