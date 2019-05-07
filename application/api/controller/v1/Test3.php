<?php
/**
 * Created by PhpStorm.
 * User: hokoory
 * Date: 2018/12/24
 * Time: 15:50
 */

namespace app\api\controller\v1;

use Redis;

class Test3 {
    public function test3() {
        $redis = new Redis();

        $redis->connect('127.0.0.1', 6379);

        $password = '123456';

        $redis->auth($password);
        $arr = json([
            'id' => 66,
            'a' => 'a',
            'b' => 'b'
        ]);
        $redis->rpush("mylist", $arr->getContent());


    }


}