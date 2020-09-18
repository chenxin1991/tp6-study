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
        $list = $model->getList($this->user['user_id'], $type);
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
}