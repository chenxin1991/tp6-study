<?php

namespace app\api\controller;

use app\BaseController;
use app\models\Car as CarModel;
use app\models\Setting as SettingModel;

class CarCategory extends BaseController
{
    public function index()
    {
        $carCategory = CarModel::select();
        $setting = SettingModel::find(1);
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => [
                'carCategory' => $carCategory,
                'setting' => $setting
            ]
        ];
        return json($result);
    }
}