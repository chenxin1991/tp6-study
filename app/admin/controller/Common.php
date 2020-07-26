<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;
use app\admin\model\Car as CarModel;
use app\admin\model\OnOffGood as OnOffGoodModel;
use app\admin\model\LargeGood as LargeGoodModel;
use app\admin\model\AppletConfig as AppletConfigModel;
use app\admin\model\Leader as LeaderModel;
use app\admin\model\Category as CategoryModel;

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


    public function getAppletConfig($id)
    {
        $applet_cofig = AppletConfigModel::find($id);
        return $applet_cofig;
    }

    public function getLeaders()
    {
        $leaders = LeaderModel::select();
        return json($leaders);
    }

    public function getCategory()
    {
        $category = CategoryModel::select();
        return json($category);
    }
}