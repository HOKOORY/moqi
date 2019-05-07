<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/04/10
 * Time: 11:33
 */

namespace app\api\service;

use app\api\Model\Order as OrderModel;
use Exception;
use think\Db;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class WxNotify extends \WxPayNotify {
    public function NotifyProcess($data, &$msg) {
        if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try {
                $order = OrderModel::where('order_no', '=', $orderNo)->find();
                if ($order->status == 1) {
                    $order->save([
                        'status' => 2
                    ]);
                }
                Db::commit();
                return true;
            } catch
            (Exception $ex) {
                Db::rollback();
                Log::error($ex);
                return false;
            }
        } else {
            return true;
        }
    }
}