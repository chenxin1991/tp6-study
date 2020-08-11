<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;
use app\models\Car as CarModel;
use app\models\Goods as GoodsModel;
use app\admin\model\Leader as LeaderModel;
use app\models\Category as CategoryModel;
use app\models\Setting as SettingModel;

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

    public function getGoods()
    {
        $goods = GoodsModel::select();
        return json($goods);
    }

    public function getSetting($id)
    {
        $setting = SettingModel::find($id);
        return $setting;
    }

    public function getLeaders()
    {
        $leaders = LeaderModel::select();
        return json($leaders);
    }

    public function getCategory()
    {
        $category = CategoryModel::order('sort')->select();
        return json($category);
    }
}