<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\ResidentOrder as ResidentOrderModel;
use think\facade\Cache;

class ResidentOrder extends BaseController
{
    public function index()
    {
        $number = input('number');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = ResidentOrderModel::where('number', 'like', '%' . $number . '%')->page($pageNo, $pageSize)->select()->toArray();
        $count = ResidentOrderModel::where('number', 'like', '%' . $number . '%')->count();
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
        $operator = $user['user_id'];
        $source = input('source');
        $customer = input('customer');
        $phone = input('phone');
        $appointment = input('appointment');
        $time = input('selectTime');
        $cars = input('cars');
        $routes = input('routes');
        $onoffs = input('onoffs');
        $larges = input('larges');
        $carCost = input('carCost');
        $distanceCost = input('distanceCost');
        $floorCost = input('floorCost');
        $parkingCost = input('parkingCost');
        $onoffCost = input('onoffCost');
        $largeCost = input('largeCost');
        $specialTimeCost = input('specialTimeCost');
        $totalCost = input('totalCost');
        $resident_order = new ResidentOrderModel;
        $resident_order->source = $source;
        $resident_order->appointment = $appointment;
        $resident_order->time = $time;
        $resident_order->customer = $customer;
        $resident_order->phone = $phone;
        $resident_order->cars = json_encode($cars);
        $resident_order->routes = json_encode($routes);
        $resident_order->onoffs = json_encode($onoffs);
        $resident_order->larges = json_encode($larges);
        $resident_order->car_cost = $carCost;
        $resident_order->distance_cost = $distanceCost;
        $resident_order->floor_cost = $floorCost;
        $resident_order->parking_cost = $parkingCost;
        $resident_order->onoff_cost = $onoffCost;
        $resident_order->large_cost = $largeCost;
        $resident_order->special_time_cost = $specialTimeCost;
        $resident_order->total_cost = $totalCost;
        $resident_order->operator = $operator;
        $resident_order->save();

    }

    public function edit($id)
    {
        $large_goods = LargeGoodModel::find($id);
        $name = input('name');
        $price = input('price');
        $unit = input('unit');
        $large_goods->name = $name;
        $large_goods->price = $price;
        $large_goods->unit = $unit;
        $large_goods->save();
    }

    public function del($id)
    {
        CarModel::destroy($id);
    }
}