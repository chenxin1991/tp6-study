<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\OnOffGood as OnOffGoodModel;

class OnOffGood extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = OnOffGoodModel::where('name', 'like', '%'.$name.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = OnOffGoodModel::where('name', 'like', '%'.$name.'%')->count();
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
        $on_off_goods = new OnOffGoodModel;
        $on_off_goods->name = $name;
        $on_off_goods->price = $price;
        $on_off_goods->unit = $unit;
        $on_off_goods->save();

    }

    public function edit($id)
    {
        $on_off_goods = OnOffGoodModel::find($id);
        $name = input('name');
        $price = input('price');
        $unit = input('unit');
        $on_off_goods->name = $name;
        $on_off_goods->price = $price;
        $on_off_goods->unit = $unit;
        $on_off_goods->save();
    }

    public function del($id)
    {
        CarModel::destroy($id);
    }
}