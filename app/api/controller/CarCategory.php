<?php

namespace app\api\controller;

use app\BaseController;
use app\models\Car as CarModel;

class CarCategory extends BaseController
{
    public function index()
    {
        $carCategory = CarModel::select();
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => [
                'carCategory' => $carCategory
            ]
        ];
        return json($result);
    }
}