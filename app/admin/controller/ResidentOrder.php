<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\ResidentOrder as ResidentOrderModel;

class ResidentOrder extends BaseController
{
    public function index()
    {
        $where = [];
        $keyword = input('keyword');
        if (!empty($keyword)) {
            $where[] = ['number|customer|phone', 'like', '%' . $keyword . '%'];
        }
        $orderDate = input('orderDate');
        if (!empty($orderDate) && !empty($orderDate[0]) && !empty($orderDate[1])) {
            $where[] = ['create_time', 'between', [$orderDate[0] . ' 00:00:00', $orderDate[1] . ' 23:59:59']];
        }
        $appointDate = input('appointDate');
        if (!empty($appointDate) && !empty($appointDate[0]) && !empty($appointDate[1])) {
            $where[] = ['appointDate', 'between', $appointDate];
        }
        $source = input('source');
        if (!empty($source)) {
            $where[] = ['source', '=', $source];
        }
        $orderStatus = input('orderStatus');
        if ($orderStatus != '') {
            $where[] = ['orderStatus', '=', $orderStatus];
        }
        $payStatus = input('payStatus');
        if ($payStatus != '') {
            $where[] = ['payStatus', '=', $payStatus];
        }

        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = ResidentOrderModel::with(['admin', 'leader'])->where($where)
            ->page($pageNo, $pageSize)->order('create_time', 'desc')->select();
        $count = ResidentOrderModel::where($where)->count();
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $data,
                'pageNo' => $pageNo,
                'pageSize' => $pageSize,
                'totalCount' => $count,
                'totalPage' => (int)($count / $pageSize) + 1
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

    public function add()
    {
        $admin = request()->admin;
        $date = date('Ymd');
        $order = ResidentOrderModel::whereDay('create_time')->order('create_time', 'desc')->find();
        if ($order) {
            $newNumber = intval(substr($order->number, -4)) + 1;
            $newStr = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $orderNumber = $date . $newStr;
        } else {
            $orderNumber = $date . '0001';
        }
        $operator = $admin['user_id'];
        $source = input('source');
        $customer = input('customer');
        $phone = input('phone');
        $appointDate = input('appointDate');
        $appointTime = input('appointTime');
        $cars = input('cars');
        $routes = input('routes');
        $goods = input('goods');
        $distance = input('distance');
        $carCost = input('carCost');
        $distanceCost = input('distanceCost');
        $floorCost = input('floorCost');
        $parkingCost = input('parkingCost');
        $goodsCost = input('goodsCost');
        $specialTimeCost = input('specialTimeCost');
        $totalCost = input('totalCost');
        $remark = input('remark');
        $residentOrder = new ResidentOrderModel;
        $residentOrder->number = $orderNumber;
        $residentOrder->source = $source;
        $residentOrder->appointDate = $appointDate;
        $residentOrder->appointTime = $appointTime;
        $residentOrder->customer = $customer;
        $residentOrder->phone = $phone;
        $residentOrder->cars = $cars;
        $residentOrder->routes = $routes;
        $residentOrder->goods = $goods;
        $residentOrder->distance = $distance;
        $residentOrder->carCost = $carCost;
        $residentOrder->distanceCost = $distanceCost;
        $residentOrder->floorCost = $floorCost;
        $residentOrder->parkingCost = $parkingCost;
        $residentOrder->goodsCost = $goodsCost;
        $residentOrder->specialTimeCost = $specialTimeCost;
        $residentOrder->totalCost = $totalCost;
        $residentOrder->operator = $operator;
        $residentOrder->orderStatus = 0;
        $residentOrder->payStatus = 0;
        $residentOrder->remark = $remark;
        $residentOrder->save();
    }

    public function edit($id)
    {
        $residentOrder = ResidentOrderModel::find($id);
        $source = input('source');
        $customer = input('customer');
        $phone = input('phone');
        $appointDate = input('appointDate');
        $appointTime = input('appointTime');
        $cars = input('cars');
        $routes = input('routes');
        $goods = input('goods');
        $distance = input('distance');
        $carCost = input('carCost');
        $distanceCost = input('distanceCost');
        $floorCost = input('floorCost');
        $parkingCost = input('parkingCost');
        $goodsCost = input('goodsCost');
        $specialTimeCost = input('specialTimeCost');
        $totalCost = input('totalCost');
        $isOrigin = input('isOrigin');
        $remark = input('remark');
        $residentOrder->source = $source;
        $residentOrder->appointDate = $appointDate;
        $residentOrder->appointTime = $appointTime;
        $residentOrder->customer = $customer;
        $residentOrder->phone = $phone;
        $residentOrder->cars = $cars;
        $residentOrder->routes = $routes;
        $residentOrder->goods = $goods;
        $residentOrder->distance = $distance;
        $residentOrder->carCost = $carCost;
        $residentOrder->distanceCost = $distanceCost;
        $residentOrder->floorCost = $floorCost;
        $residentOrder->parkingCost = $parkingCost;
        $residentOrder->goodsCost = $goodsCost;
        $residentOrder->specialTimeCost = $specialTimeCost;
        $residentOrder->totalCost = $totalCost;
        $residentOrder->isOrigin = $isOrigin;
        $residentOrder->remark = $remark;
        $residentOrder->save();
    }

    public function del($id)
    {
        ResidentOrderModel::destroy($id);
    }

    public function confirm($id)
    {
        $admin = request()->admin;
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = 1;
        $model->operator = $admin['user_id'];
        $model->confirmTime = date('Y-m-d H:i:s', time());
        $model->save();
    }

    public function dispatch($id)
    {
        $leader = input('leader');
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = 2;
        $model->leader = $leader;
        $model->dispatchTime = date('Y-m-d H:i:s', time());
        $model->save();
    }

    public function cancel($id)
    {
        $cancelReason = input('cancelReason');
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = -1;
        $model->cancelReason = $cancelReason;
        $model->cancelTime = date('Y-m-d H:i:s', time());
        $model->save();
    }
}