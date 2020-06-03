<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Role as RoleModel;

class Common extends BaseController
{
    public function getRoles()
    {
        $roles = RoleModel::select();
        return json($roles);
    }
}