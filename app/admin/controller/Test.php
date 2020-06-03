<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;
use app\admin\model\Admin as AdminModel;

class Test extends BaseController
{
    public function index()
    {
        $article = AdminModel::with('role')->select()->toArray();
        echo "<pre>";print_r($article);
    }
}