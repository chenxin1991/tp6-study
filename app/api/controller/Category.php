<?php

namespace app\api\controller;

use app\BaseController;
use app\models\Car as CarModel;
use app\models\Goods as GoodsModel;
use app\models\Category as CategoryModel;


class Category extends BaseController
{
    public function index()
    {
        $data = [];
        $cars = CarModel::select()->toArray();
        foreach ($cars as $key => $value) {
            $cars[$key]['id'] = 'car_' . $value['id'];
        }
        $data[] = ['name' => '用车', 'goods' => $cars];
        $data[] = ['name' => '起始地','goods'=>[]];
        $category = CategoryModel::order('sort')->select()->toArray();
        foreach ($category as $key => $value) {
            $goods = GoodsModel::where('cid', $value['id'])->select()->toArray();
            $data[] = ['name' => $value['name'], 'goods' => $goods];
        }
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => $data
        ];

        return json($result);
    }
}