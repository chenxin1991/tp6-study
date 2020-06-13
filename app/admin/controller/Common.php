<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;
use app\admin\model\Car as CarModel;
use app\admin\model\OnOffGood as OnOffGoodModel;
use app\admin\model\LargeGood as LargeGoodModel;

class Common extends BaseController
{
    public function getRoles()
    {
        $roles = RoleModel::select();
        return json($roles);
    }

    public function getCars()
    {
        $cars = CarModel::select();
        return json($cars);
    }

    public function getOnOffGoods()
    {
        $on_off_goods = OnOffGoodModel::select();
        return json($on_off_goods);
    }

    public function getLargeGoods()
    {
        $large_goods = LargeGoodModel::select();
        return json($large_goods);
    }
}