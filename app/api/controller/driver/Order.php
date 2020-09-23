<?php

namespace app\api\controller\driver;

use app\BaseController;
use app\models\ResidentOrder as orderModel;
use app\models\Leader as LeaderModel;

require_once '../extend/WxPay/lib/WxPay.NativePay.php';
require_once '../extend/WxPay/lib/WxPay.Config.php';
require_once '../extend/WxPay/example/phpqrcode/phpqrcode.php';

class Order extends BaseController
{
    private $user;

    public function __construct()
    {
        $this->user = request()->user;   // 用户信息
    }

    public function list($type)
    {
        $leader = LeaderModel::where('phone', $this->user->mobile)->find();
        $leader_id = $leader->id;
        $model = new OrderModel;
        $list = $model->driverOrderList($leader_id, $type);
        foreach ($list as $key => $value) {
            foreach ($value['cars'] as $key2 => $value2) {
                $value['cars'][$key2]['id'] = 'car_' . $value['cars'][$key2]['id'];
            }
            $list[$key]['carsAndGoods'] = array_merge($value['cars'], $value['goods']);
        }
        return json([
            'code' => 1,
            'data' => [
                'list' => $list
            ],
            'msg' => 'success'
        ]);
    }

    public function detail($id)
    {
        $order = OrderModel::where(['id' => $id])->find()->toArray();
        foreach ($order['cars'] as $key => $value) {
            $order['cars'][$key]['id'] = 'car_' . $order['cars'][$key]['id'];
        }
        $order['carsAndGoods'] = array_merge($order['cars'], $order['goods']);
        return json([
            'code' => 1,
            'data' => [
                'order' => $order
            ],
            'msg' => 'success'
        ]);
    }


    //返回收款url
    public function payUrl($id)
    {
        $order = OrderModel::where(['id' => $id])->find();
        $notify = new \NativePay();
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("搬家费");
        $input->SetAttach("小程序");
        $input->SetOut_trade_no(date("YmdHis") . '_' . $order->id);
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("https://demo.wjdhbq.com/index.php/api/user/order/replyNotify");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        return json([
            'code' => 1,
            'data' => [
                'code_url' => $result["code_url"]
            ],
            'msg' => 'success'
        ]);
    }

    public function qrcode()
    {
        $url = urldecode($_GET["data"]);
        if (substr($url, 0, 6) == "weixin") {
            \QRcode::png($url);
        } else {
            header('HTTP/1.1 404 Not Found');
        }
    }
}