<?php

namespace app\api\controller;

use app\BaseController;
use app\models\ResidentOrder as ResidentOrderModel;

class ResidentOrder extends BaseController
{
    public function add()
    {
        $userInfo = request()->user;
        $date = date('Ymd');
        $order = ResidentOrderModel::whereDay('create_time')->order('create_time', 'desc')->find();
        if ($order) {
            $newNumber = intval(substr($order->number, -4)) + 1;
            $newStr = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $orderNumber = $date . $newStr;
        } else {
            $orderNumber = $date . '0001';
        }
        $source = 3;//小程序
        $customer = $userInfo['nickName'];
        $phone = input('mobile');
        $appointDate = input('appointDate');
        $appointTime = input('appointTime');
        $cars = input('cars');
        $cars = json_decode(htmlspecialchars_decode($cars), true);
        foreach ($cars as $key => $value) {
            $cars[$key]['key'] = $key;
            $cars[$key]['id'] = intval(substr($value['id'], 4));
            $cars[$key]['total'] = (float)($value['num'] * $value['price']);
        }
        $routes = [];
        $addressFrom = input('addressFrom');
        $addressFrom = json_decode(htmlspecialchars_decode($addressFrom), true);
        $routes[] = [
            'key' => 0,
            'title' => $addressFrom['address']['name'],
            'select_title' => $addressFrom['address']['name'],
            'address' => $addressFrom['address']['address'],
            'location' => [
                'lat' => $addressFrom['address']['latitude'],
                'lng' => $addressFrom['address']['longitude']
            ],
            'room_number' => $addressFrom['room_number'],
            'stairs_or_elevators' => strval($addressFrom['stairs_or_elevators']),
            'floor_num' => $addressFrom['floor_num'],
            'parking_distance' => strval($addressFrom['parking_distance'])
        ];
        $addressTo = input('addressTo');
        $addressTo = json_decode(htmlspecialchars_decode($addressTo), true);
        $routes[] = [
            'key' => 1,
            'title' => $addressTo['address']['name'],
            'select_title' => $addressFrom['address']['name'],
            'address' => $addressTo['address']['address'],
            'location' => [
                'lat' => $addressTo['address']['latitude'],
                'lng' => $addressTo['address']['longitude']
            ],
            'room_number' => $addressTo['room_number'],
            'stairs_or_elevators' => strval($addressTo['stairs_or_elevators']),
            'floor_num' => $addressTo['floor_num'],
            'parking_distance' => strval($addressTo['parking_distance'])
        ];
        $goods = [];
        $i = 0;
        $cart = input('cart');
        $cart = json_decode(htmlspecialchars_decode($cart), true);
        foreach ($cart as $key => $value) {
            if (!strstr($value['id'], 'car_') && !strstr($value['id'], 'other_')) {
                $cart[$key]['key'] = $i;
                $cart[$key]['total'] = (float)($value['num'] * $value['price']);
                $goods[] = $cart[$key];

            } else if (strstr($value['id'], 'other_')) {
                $cart[$key]['key'] = $i;
                $goods[] = $cart[$key];
            }
            $i++;
        }
        $distance = (float)(input('distance'));
        $carCost = input('carCost');
        $distanceCost = input('distanceCost');
        $goodsCost = input('largeCost');
        $floorCost = input('floorCost');
        $parkingCost = input('parkingCost');
        $specialTimeCost = input('specialTimeCost');
        $totalCost = input('totalCost');
        $isOtherLarge = input('isOtherLarge');
        $userMobile = input('userMobile');
        $remark = input('remark');
        $user_id = $userInfo['user_id'];
        $residentOrder = new ResidentOrderModel;
        $residentOrder->number = $orderNumber;
        $residentOrder->source = $source;
        $residentOrder->customer = $customer;
        $residentOrder->phone = $phone;
        $residentOrder->appointDate = $appointDate;
        $residentOrder->appointTime = $appointTime;
        $residentOrder->cars = $cars;
        $residentOrder->routes = $routes;
        $residentOrder->goods = $goods;
        $residentOrder->distance = $distance;
        $residentOrder->carCost = $carCost;
        $residentOrder->distanceCost = $distanceCost;
        $residentOrder->goodsCost = $goodsCost;
        $residentOrder->floorCost = $floorCost;
        $residentOrder->parkingCost = $parkingCost;
        $residentOrder->specialTimeCost = $specialTimeCost;
        $residentOrder->totalCost = $totalCost;
        $residentOrder->user_id = $user_id;
        $residentOrder->orderStatus = 0;//待确认
        $residentOrder->payStatus = 0;//待支付
        $residentOrder->isOtherLarge = $isOtherLarge;
        $residentOrder->isOrigin = $isOtherLarge;
        $residentOrder->userMobile = $userMobile;
        $residentOrder->remark = $remark;
        $residentOrder->save();
        return json([
            'code' => 1,
            'data' => [
                'id' => $residentOrder->id,
                'number' => $residentOrder->number,
                'create_time' => $residentOrder->create_time
            ],
            'msg' => 'success'
        ]);
    }
}