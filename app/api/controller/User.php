<?php

namespace app\api\controller;

use app\BaseController;
use app\api\model\User as UserModel;
use think\Request;

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
    public function login(Request $request)
    {
        $model = new UserModel;
        $user_id = $model->login($request->post());
        $token = $model->getToken();
        return json(['code' => 1, 'data' => ['token' => $token, 'user_id' => $user_id], 'msg' => 'success']);
    }

    public function detail()
    {
        // 当前用户信息
        if (!$token = request()->param('token')) {
            return json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }
        if (!$userInfo = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        return json(['code' => 1, 'data' => ['userInfo' => $userInfo], 'msg' => 'success']);
    }

    public function uploadImage()
    {
        // 当前用户信息
        if (!$token = request()->param('token')) {
            return json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }
        if (!$userInfo = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        $file = request()->file('file');
        $savename = \think\facade\Filesystem::disk('public')->putFile('wechat', $file);
        return json([
            'code' => '1',
            'image_url' => $this->app->config->get('app.app_host') . '/storage/' . str_replace('\\', '/', $savename)
        ]);
    }

}
