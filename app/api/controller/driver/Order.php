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
}