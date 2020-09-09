<?php

namespace app\api\controller;

use app\BaseController;
use app\api\model\User as UserModel;

/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends BaseController
{
    /**
     * 用户自动登录
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $model = new UserModel;
        $user_id = $model->login(request()->post());
        $token = $model->getToken();
        return json(['code' => 1, 'data' => ['token' => $token, 'user_id' => $user_id], 'msg' => 'success']);
    }

}
