<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\Car as CarModel;

class Car extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = CarModel::where('name', 'like', '%'.$name.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = CarModel::where('name', 'like', '%'.$name.'%')->count();
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
        $image_url = input('image_url');
        $loadSize = input('loadSize');
        $lwh = input('lwh');
        $volume = input('volume');
        $manning = input('manning');
        $km_standard = input('km_standard');
        $km_price = input('km_price');
        $floor_standard = input('floor_standard');
        $floor_price = input('floor_price');
        $distance1 = input('distance1');
        $distance2 = input('distance2');
        $distance3 = input('distance3');
        $distance4 = input('distance4');
        $car = new CarModel;
        $car->name = $name;
        $car->price = $price;
        $car->image_url = $image_url;
        $car->loadSize = $loadSize;
        $car->lwh = $lwh;
        $car->volume = $volume;
        $car->manning = $manning;
        $car->km_standard = $km_standard;
        $car->km_price = $km_price;
        $car->floor_standard = $floor_standard;
        $car->floor_price = $floor_price;
        $car->distance1 = $distance1;
        $car->distance2 = $distance2;
        $car->distance3 = $distance3;
        $car->distance4 = $distance4;
        $car->save();

    }

    public function edit($id)
    {
        $car = CarModel::find($id);
        $name = input('name');
        $price = input('price');
        $image_url = input('image_url');
        $loadSize = input('loadSize');
        $lwh = input('lwh');
        $volume = input('volume');
        $manning = input('manning');
        $km_standard = input('km_standard');
        $km_price = input('km_price');
        $floor_standard = input('floor_standard');
        $floor_price = input('floor_price');
        $distance1 = input('distance1');
        $distance2 = input('distance2');
        $distance3 = input('distance3');
        $distance4 = input('distance4');
        $car->name = $name;
        $car->price = $price;
        $car->image_url = $image_url;
        $car->loadSize = $loadSize;
        $car->lwh = $lwh;
        $car->volume = $volume;
        $car->manning = $manning;
        $car->km_standard = $km_standard;
        $car->km_price = $km_price;
        $car->floor_standard = $floor_standard;
        $car->floor_price = $floor_price;
        $car->distance1 = $distance1;
        $car->distance2 = $distance2;
        $car->distance3 = $distance3;
        $car->distance4 = $distance4;
        $car->save();
    }

    public function del($id)
    {
        CarModel::destroy($id);
    }
}