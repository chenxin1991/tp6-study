<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\ResidentOrder as ResidentOrderModel;

class ResidentOrder extends BaseController
{
    public function index()
    {
        $number = input('number');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = ResidentOrderModel::where('number', 'like', '%'.$number.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = ResidentOrderModel::where('number', 'like', '%'.$number.'%')->count();
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
        $name = input('name');
        $price = input('price');
        $unit = input('unit');
        $large_goods = new LargeGoodModel;
        $large_goods->name = $name;
        $large_goods->price = $price;
        $large_goods->unit = $unit;
        $large_goods->save();

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