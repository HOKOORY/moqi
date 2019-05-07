<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 13/3/2018
 * Time: 下午 2:20
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception {
    //code 是状态码，404，200；
    public $code = 400;
    //具体错误
    public $msg = '参数错误';
    //自定义错误码
    public $errorCode = 10000;

    public function  __construct($params=[]) {
        if (!is_array($params)){
            return ;
        }
        if (array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if (array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
    }
}