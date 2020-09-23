<?php

namespace app\api\controller\driver;

use app\BaseController;
use app\models\ResidentOrder as orderModel;
use app\models\Leader as LeaderModel;

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


    //返回收款二维码
    public function qrcode($id)
    {
        $notify = new NativePay();
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no("sdkphp123456789" . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        return json([
            'code' => 1,
            'data' => [
                'url' => $result["code_url"]
            ],
            'msg' => 'success'
        ]);
    }
}