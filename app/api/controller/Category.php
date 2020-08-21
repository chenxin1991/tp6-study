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
        $data[] = ['name' => '用车', 'goods' => $cars, 'is_free' => 0];
        $data[] = ['name' => '起始地', 'goods' => [], 'is_free' => 1];
        $category = CategoryModel::order('sort')->select()->toArray();
        foreach ($category as $key => $value) {
            $goods = GoodsModel::where('cid', $value['id'])->order('sort')->select()->toArray();
            foreach ($goods as $k => $v) {
                $goods[$k]['image_url'] = $v['images'][0]['url'];
            }
            $data[] = ['name' => $value['name'], 'is_free' => $value['is_free'], 'goods' => $goods];
        }
        $data[] = ['name' => '其他大件', 'goods' => [], 'is_free' => 1];
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => $data
        ];

        return json($result);
    }
}