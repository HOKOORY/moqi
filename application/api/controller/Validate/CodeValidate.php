<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 09:24
 */

namespace app\api\controller\Validate;


class CodeValidate extends BaseValidate {
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];
}