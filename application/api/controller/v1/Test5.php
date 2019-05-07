<?php
/**
 * Created by PhpStorm.
 * User: rungame
 * Date: 2019/3/28
 * Time: 14:14
 */

namespace app\api\controller\v1;


class Test5 {
    public function Test5() {
        return  Math::i*Math::i;
    }
}

class Math {
    const p = 3.14;
    const i = 2;
}