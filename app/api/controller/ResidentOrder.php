<?php

namespace app\api\controller;

use app\BaseController;
use app\api\model\User as UserModel;
use app\models\ResidentOrder as ResidentOrderModel;

class ResidentOrder extends BaseController
{
    public function add()
    {
        if (!$token = request()->param('token')) {
            return json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }
        if (!$userInfo = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        $date = date('Ymd');
        $order = ResidentOrderModel::whereDay('create_time')->order('create_time', 'desc')->find();
        if ($order) {
            $newNumber = intval(substr($order->number, -4)) + 1;
            $newStr = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $orderNumber = $date . $newStr;
        } else {
            $orderNumber = $date . '0001';
        }
        $source = 3;
        $customer = $userInfo['nickName'];
        $phone = input('mobile');
        $appointDate = input('appointDate');
        $appointTime = input('appointTime');
        $cars = input('cars');
        $cars = json_decode(htmlspecialchars_decode($cars), true);
        foreach ($cars as $key => $value) {
            $cars[$key]['key'] = $key;
        }
        $routes = [];
        $addressFrom = input('addressFrom');
        $addressFrom = json_decode(htmlspecialchars_decode($addressFrom), true);
        $routes[] = [
            'key' => 0,
            'title' => $addressFrom['address']['name'],
            'address' => $addressFrom['address']['address'],
            'location' => [
                'lat' => $addressFrom['address']['latitude'],
                'lng' => $addressFrom['address']['longitude']
            ],
            'room_number' => $addressFrom['room_number'],
            'stairs_or_elevators' => $addressFrom['stairs_or_elevators'],
            'floor_num' => $addressFrom['floor_num'],
            'parking_distance' => $addressFrom['parking_distance']
        ];
        $addressTo = input('addressTo');
        $addressTo = json_decode(htmlspecialchars_decode($addressTo), true);
        $routes[] = [
            'key' => 1,
            'title' => $addressTo['address']['name'],
            'address' => $addressTo['address']['address'],
            'location' => [
                'lat' => $addressTo['address']['latitude'],
                'lng' => $addressTo['address']['longitude']
            ],
            'room_number' => $addressTo['room_number'],
            'stairs_or_elevators' => $addressTo['stairs_or_elevators'],
            'floor_num' => $addressTo['floor_num'],
            'parking_distance' => $addressTo['parking_distance']
        ];
        $goods = [];
        $i = 0;
        $cart = input('cart');
        $cart = json_decode(htmlspecialchars_decode($cart), true);
        foreach ($cart as $key => $value) {
            if(!strstr($value['id'],'car_')){
                $cart[$key]['key'] = $i;
                $goods[] = $cart[$key];
                $i++;
            }
        }
        $distance = input('distance');
        $carCost = input('carCost');
        $distanceCost = input('distanceCost');
        $goodsCost = input('largeCost');
        $floorCost = input('floorCost');
        $parkingCost = input('parkingCost');
        $specialTimeCost = input('specialTimeCost');
        $totalCost = input('totalCost');
        $user_id = $userInfo['user_id'];
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
        if ($source == 2) {
            $residentOrder->orderStatus = 0;
        } else {
            $residentOrder->orderStatus = 1;
        }
        $residentOrder->payStatus = 0;
        $residentOrder->save();
    }
}