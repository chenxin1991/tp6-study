<?php

namespace app\api\controller;

use app\BaseController;
use app\models\CompanyOrder as OrderModel;

class CompanyOrder extends BaseController
{
    public function add()
    {
        $date = date('Ymd');
        $order = OrderModel::whereDay('create_time')->order('number', 'desc')->find();
        if ($order) {
            $newNumber = intval(substr($order->number, -4)) + 1;
            $newStr = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $orderNumber = 'B' . $date . $newStr;
        } else {
            $orderNumber = 'B' . $date . '0001';
        }
        $userInfo = request()->user;
        $user_id = $userInfo['user_id'];
        $name = input('name');
        $customer = input('customer');
        $phone = input('phone');
        $description = input('description');
        $userMobile = input('userMobile');
        $order = new OrderModel;
        $order->number = $orderNumber;
        $order->source = 3;//小程序下单
        $order->type = 3;//常规项目
        $order->name = $name;
        $order->customer = $customer;
        $order->phone = $phone;
        $order->description = $description;
        $order->user_id = $user_id;
        $order->userMobile = $userMobile;
        if ($order->save()) {
            return json([
                'code' => 1,
                'data' => [],
                'msg' => 'success'
            ]);
        }
    }
}