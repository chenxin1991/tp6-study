<?php

namespace app\api\controller;

use app\BaseController;
use app\api\model\User as UserModel;

class ResidentOrder extends BaseController
{
    public function add()
    {
        if (!$token = request()->param('token')) {
            return json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }
        if (!$userInfo = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        return json(['code' => 1, 'msg' => 'success']);
    }
}