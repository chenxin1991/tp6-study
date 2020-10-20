<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;
use app\admin\model\Admin as AdminModel;
use app\models\Car as CarModel;
use app\models\Goods as GoodsModel;
use app\models\Leader as LeaderModel;
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

    public function getSetting()
    {
        $setting = SettingModel::find(1);
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

    public function getProjectLeader()
    {
        $options = [];
        $roles = RoleModel::select([23, 24, 25]);
        foreach ($roles as $key => $value) {
            $children = [];
            $admin = AdminModel::where('role_id', $value['id'])->select();
            foreach ($admin as $key2 => $value2) {
                $children[] = ['value' => $value2['id'], 'label' => $value2['name']];
            }
            $options[] = ['value' => $value['id'], 'label' => $value['name'], 'children' => $children];
        }
        return json($options);
    }
}