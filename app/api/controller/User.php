<?php

namespace app\api\controller;

use app\BaseController;
use app\models\User as UserModel;

/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends BaseController
{
    public function login()
    {
        $model = new UserModel;
        $user_id = $model->login(request()->post());
        $token = $model->getToken();
        return json(['code' => 1, 'data' => ['token' => $token, 'user_id' => $user_id], 'msg' => 'success']);
    }

}
