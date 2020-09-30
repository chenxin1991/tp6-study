<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\CompanyOrder as OrderModel;

class CompanyOrder extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = OrderModel::where('name', 'like', '%' . $name . '%')->page($pageNo, $pageSize)->select()->toArray();
        $count = OrderModel::where('name', 'like', '%' . $name . '%')->count();
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

        $source = input('source');
        $name = input('name');
        $customer = input('customer');
        $phone = input('phone');
        $description = input('description');
        $order = new OrderModel;
        $order->source = $source;
        $order->name = $name;
        $order->customer = $customer;
        $order->phone = $phone;
        $order->description = $description;
        $order->save();
    }

    public function edit($id)
    {
        $order = OrderModel::find($id);
        $source = input('source');
        $name = input('name');
        $customer = input('customer');
        $phone = input('phone');
        $description = input('description');
        $order->source = $source;
        $order->name = $name;
        $order->customer = $customer;
        $order->phone = $phone;
        $order->description = $description;
        $order->save();
    }

    public function del($id)
    {
        OrderModel::destroy($id);
    }
}
