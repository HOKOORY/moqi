<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/3/2018
 * Time: 12:00 PM
 */
namespace app\api\service;

use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use app\api\Model\User as UserModel;
use app\api\Model\Order as OrderModel;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class Pay {
    private $orderNO;
    private $price;
    private $userid;

    public function __construct($orderNO, $price, $userid) {
        if (!$orderNO) {
            throw new Exception('订单号不允许为空');
        }
        $this->orderNO = $orderNO;
        $this->price = $price;
        $this->userid = $userid;
    }

    public function pay() {
        return $this->makeWxPreOrder($this->price);
    }

    private function makeWxPreOrder($totalPrice) {
        $user = UserModel::where('id', '=', $this->userid)->find();
        $openid = $user['openid'];
        if (!$openid) {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody('加密图片');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
        return $this->getPatSignture($wxOrderData);
    }

    private function getPatSignture($wxOrderData) {
        $config = new \WxPayConfig();
        $wxOrder = \WxPayApi::unifiedOrder($config,$wxOrderData);
        if ($wxOrder['return_code'] <> 'SUCCESS' ||
            $wxOrder['result_code'] <> 'SUCCESS') {
            Log::record($wxOrder, 'error');
            Log::record('获取预支付订单失败', 'error');
            return $wxOrder;
        }
        $prepay_id = $wxOrder['prepay_id'];
        $signature = $this->sign($wxOrder);
        return [
            'prepay_id' => $prepay_id,
            'sign' => $signature
        ];
    }

    private function sign($wxOrder) {
        $config = new \WxPayConfig();
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((String)time());
        $rand = md5(time() . mt_rand(1, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetSignType('MD5');
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $sign = $jsApiPayData->MakeSign($config);
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }

    private function recordPreOrder($wxOrder) {
        OrderModel::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }
}