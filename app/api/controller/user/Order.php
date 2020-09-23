<?php

namespace app\api\controller\user;

use app\BaseController;
use app\models\ResidentOrder as orderModel;

class Order extends BaseController
{
    private $user;

    public function __construct()
    {
        $this->user = request()->user;   // 用户信息
    }

    public function list($type)
    {
        $model = new OrderModel;
        $list = $model->getList($this->user['mobile'], $type);
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
        $carNum = 0;
        $order = OrderModel::where(['id' => $id])->find()->toArray();
        foreach ($order['cars'] as $key => $value) {
            $order['cars'][$key]['id'] = 'car_' . $value['id'];
            $carNum += $value['num'];
        }
        $order['carsAndGoods'] = array_merge($order['cars'], $order['goods']);
        $order['carNum'] = $carNum;
        return json([
            'code' => 1,
            'data' => [
                'order' => $order
            ],
            'msg' => 'success'
        ]);
    }

    public function cancel($id)
    {
        $cancelReason = input('cancelReason');
        $model = OrderModel::find($id);
        $model->orderStatus = -1;
        $model->cancelReason = $cancelReason;
        $model->cancelTime = date('Y-m-d H:i:s', time());
        if ($model->save()) {
            return json([
                'code' => 1,
                'data' => [
                ],
                'msg' => 'success'
            ]);
        }
    }

    public function signIn($id)
    {
        $model = OrderModel::find($id);
        $model->orderStatus = 3;
        $model->signTime = date('Y-m-d H:i:s', time());
        if ($model->save()) {
            return json([
                'code' => 1,
                'data' => [
                ],
                'msg' => 'success'
            ]);
        }
    }

    public function modifyTotalCost($id)
    {
        $newTotalCost = input('newTotalCost');
        $costChangeRemark = input('costChangeRemark');
        $model = orderModel::find($id);
        if ($model->totalCost != $newTotalCost) {
            $model->changeCost = $newTotalCost - $model->totalCost;
            $model->costChangeRemark = $costChangeRemark;
            $model->totalCost = $newTotalCost;
            if ($model->save()) {
                return json([
                    'code' => 1,
                    'data' => [
                    ],
                    'msg' => 'success'
                ]);
            }
        }
    }

    //微信支付异步通知支付结果
    public function replyNotify()
    {
        //获取返回的xml
        $testxml = file_get_contents("php://input");
        //将xml转化为json格式
        $jsonxml = json_encode(simplexml_load_string($testxml, 'SimpleXMLElement', LIBXML_NOCDATA));
        //转成数组
        $result = json_decode($jsonxml, true);
        file_put_contents('log.txt',$result);
        if ($result) {
            //如果成功返回了
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                //进行改变订单状态等操作。。。。
            }
        }
    }
}