<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/04/02
 * Time: 10:49
 */

namespace app\api\service;

use app\api\Model\Order as OrderModel;
use app\api\service\Pay as PayServeice;

class Order {
    public static function CreatePreOreder($id, $price) {
        $orderNO = self::makeOrderNo();
        $pay = new PayServeice($orderNO, $price, $id);
        $prepay = $pay->pay();
        OrderModel::create([
            'user_id' => $id,
            'price' => $price,
            'order_no' => $orderNO,
            'prepay_id' => $prepay['prepay_id'],
            'status' => 1,
        ]);
        return [
            'orderNO' => $orderNO,
            'prepay_id' => $prepay['prepay_id'],
            'sign' => $prepay['sign']
        ];
    }

    public static function makeOrderNo() {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }
}