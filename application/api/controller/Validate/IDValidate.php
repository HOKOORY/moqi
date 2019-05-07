<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/26
 * Time: 15:06
 */

namespace app\api\controller\Validate;


class IDValidate extends BaseValidate {
    protected $rule = [
        'id' => 'require|isNotEmpty|isPositiveInteger'
    ];
}