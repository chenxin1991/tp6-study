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
        $data = ResidentOrderModel::with(['user','leader'])->where('number', 'like', '%' . $keyword . '%')->page($pageNo, $pageSize)->select()->toArray();
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
        $token = request()->token;
        $user = Cache::get($token);
        $date = date('Ymd');
        $order = ResidentOrderModel::whereDay('create_time')->order('create_time', 'desc')->find();
        if ($order) {
            $new_number = intval(substr($order->number, -4)) + 1;
            $new_str = str_pad($new_number, 4, "0", STR_PAD_LEFT);
            $order_number = $date . $new_str;
        } else {
            $order_number = $date . '0001';
        }
        $operator = $user['user_id'];
        $source = input('source');
        $customer = input('customer');
        $phone = input('phone');
        $appointment = input('appointment');
        $time = input('time');
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
        $resident_order = new ResidentOrderModel;
        $resident_order->number = $order_number;
        $resident_order->source = $source;
        $resident_order->appointment = $appointment;
        $resident_order->time = $time;
        $resident_order->customer = $customer;
        $resident_order->phone = $phone;
        $resident_order->cars = $cars;
        $resident_order->routes = $routes;
        $resident_order->goods = $goods;
        $resident_order->distance = $distance;
        $resident_order->car_cost = $carCost;
        $resident_order->distance_cost = $distanceCost;
        $resident_order->floor_cost = $floorCost;
        $resident_order->parking_cost = $parkingCost;
        $resident_order->goods_cost = $goodsCost;
        $resident_order->special_time_cost = $specialTimeCost;
        $resident_order->total_cost = $totalCost;
        $resident_order->operator = $operator;
        if ($source == 2) {
            $resident_order->order_status = 0;
        } else {
            $resident_order->order_status = 1;
        }
        $resident_order->pay_status = 0;
        $resident_order->save();
    }

    public function edit($id)
    {
        $resident_order = ResidentOrderModel::find($id);
        $source = input('source');
        $customer = input('customer');
        $phone = input('phone');
        $appointment = input('appointment');
        $time = input('time');
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
        $resident_order->source = $source;
        $resident_order->appointment = $appointment;
        $resident_order->time = $time;
        $resident_order->customer = $customer;
        $resident_order->phone = $phone;
        $resident_order->cars = $cars;
        $resident_order->routes = $routes;
        $resident_order->goods = $goods;
        $resident_order->distance = $distance;
        $resident_order->car_cost = $carCost;
        $resident_order->distance_cost = $distanceCost;
        $resident_order->floor_cost = $floorCost;
        $resident_order->parking_cost = $parkingCost;
        $resident_order->goods_cost = $goodsCost;
        $resident_order->special_time_cost = $specialTimeCost;
        $resident_order->total_cost = $totalCost;
        $resident_order->save();
    }

    public function del($id)
    {
        ResidentOrderModel::destroy($id);
    }
}