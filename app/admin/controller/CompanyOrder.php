<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\CompanyOrder as OrderModel;

class CompanyOrder extends BaseController
{
    public function index()
    {
        $where = [];
        $keyword = input('keyword');
        if (!empty($keyword)) {
            $where[] = ['number|name|phone', 'like', '%' . $keyword . '%'];
        }
        $type = input('type');
        if (!empty($type)) {
            $where[] = ['type', '=', $type];
        }
        $source = input('source');
        if (!empty($source)) {
            $where[] = ['source', '=', $source];
        }
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = OrderModel::with(['manager', 'leader'])->where($where)->order('create_time', 'desc')->page($pageNo, $pageSize)->select();
        $count = OrderModel::where($where)->count();
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
        $date = date('Ymd');
        $order = OrderModel::whereDay('create_time')->order('number', 'desc')->find();
        if ($order) {
            $newNumber = intval(substr($order->number, -4)) + 1;
            $newStr = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $orderNumber = 'B' . $date . $newStr;
        } else {
            $orderNumber = 'B' . $date . '0001';
        }
        $type = input('type');
        $source = input('source');
        $name = input('name');
        $customer = input('customer');
        $phone = input('phone');
        $description = input('description');
        $order = new OrderModel;
        $order->number = $orderNumber;
        $order->type = $type;
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
        $type = input('type');
        $source = input('source');
        $name = input('name');
        $customer = input('customer');
        $phone = input('phone');
        $description = input('description');
        $order->type = $type;
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

    public function dispatch($id)
    {
        $leader = input('leader_id');
        $leader_id = $leader[1];
        print_r($leader);die;
        $model = ResidentOrderModel::find($id);
        $model->orderStatus = 2;
        $model->leader = $leader;
        $model->dispatchTime = date('Y-m-d H:i:s', time());
        $model->save();
    }
}
