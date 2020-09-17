<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\ResidentOrder as ResidentOrderModel;
use think\facade\Cache;

class ResidentOrder extends BaseController
{
    public function index()
    {
        $keyword = input('keyword');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = ResidentOrderModel::with(['admin', 'leader'])->where('number', 'like', '%' . $keyword . '%')
            ->page($pageNo, $pageSize)->order('create_time', 'desc')->select();
        $count = ResidentOrderModel::where('number', 'like', '%' . $keyword . '%')->count();
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
        $model->save();
    }

    public function dispatch($id)
    {
        $leader = input('leader');
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = 2;
        $model->leader = $leader;
        $model->save();
    }

    public function cancel($id)
    {
        $cancelReason = input('cancelReason');
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = -1;
        $model->cancelReason = $cancelReason;
        $model->save();
    }
}