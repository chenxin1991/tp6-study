<?php

namespace app\api\controller;

use app\BaseController;
use app\models\Car as CarModel;
use app\models\Goods as GoodsModel;
use app\models\Category as CategoryModel;
use app\models\Setting as SettingModel;


class Category extends BaseController
{
    public function index()
    {
        $data = [];
        $cars = CarModel::select()->toArray();
        foreach ($cars as $key => $value) {
            $cars[$key]['id'] = 'car_' . $value['id'];
        }
        $data[] = ['name' => '用车(必选)', 'goods' => $cars, 'is_free' => 0];
        $data[] = ['name' => '起始地(必选)', 'goods' => [], 'is_free' => 1];
        $category = CategoryModel::order('sort')->select()->toArray();
        foreach ($category as $key => $value) {
            $goods = GoodsModel::where('cid', $value['id'])->order('sort')->select()->toArray();
            foreach ($goods as $k => $v) {
                $goods[$k]['image_url'] = $v['images'][0]['url'];
                $goods[$k]['current'] = 0;
            }
            $data[] = ['name' => $value['name'], 'is_free' => $value['is_free'], 'is_upload' => $value['is_upload'], 'goods' => $goods];
        }
        $data[] = ['name' => '其他大件', 'goods' => [], 'is_free' => 1];

        $setting = SettingModel::find(1);
        $startDate = date('Y-m-d', strtotime('+6 hour'));
        $endDate = date('Y-m-d', strtotime('+1 month'));
        $todayTimeArray = [];
        $hour = intval(date('H', strtotime('+6 hour')));
        for ($i = $hour; $i < 24; $i++) {
            $todayTimeArray[] = str_pad($i, 2, '0', STR_PAD_LEFT).':00';
        }
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => [
                'category' => $data,
                'setting' => $setting,
                'date' => ['startDate' => $startDate, 'endDate' => $endDate, 'todayTimeArray' => $todayTimeArray]
            ]
        ];

        return json($result);
    }

    public function uploadImage()
    {
        $file = request()->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('wechat', $file);
        return json([
            'code' => '1',
            'image_url' => $this->app->config->get('app.app_host') . '/storage/' . str_replace('\\', '/', $savename)
        ]);
    }
}