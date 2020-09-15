<?php

namespace app\api\controller;

use app\common\library\wechat\WXBizDataCrypt;
use app\BaseController;
use app\models\User as UserModel;
use think\facade\Cache;


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

    public function bindPhone()
    {
        if (!$token = input('token')) {
            return json(['code' => -1, 'msg' => '缺少必要的参数：token']);
        }

        if (!$user = UserModel::getUser($token)) {
            return json(['code' => -1, 'msg' => '没有找到用户信息']);
        }
        $encryptedData = input('encryptedData');
        $iv = input('iv');
        $sessionKey = Cache::get($token)['session_key'];
        $pc = new WXBizDataCrypt('wxfeb7e646e470417e', $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        $mobile = json_decode($data, true)['phoneNumber'];
        if ($errCode == 0) {
            if (!UserModel::where('mobile', $mobile)->where('user_id','<>',$user->user_id)->find()) {
                $user->mobile = json_decode($data, true)['phoneNumber'];
                $user->save();
                return json(['code' => 1, 'data' => [], 'msg' => 'success']);
            }
        } else {
            return json(['code' => 0, 'data' => [], 'msg' => 'ffefe']);
        }
    }

    public function unbindPhone()
    {
        $user = request()->user;
        $user->mobile = '';
        $user->save();
        return json(['code' => 1, 'data' => [], 'msg' => 'success']);
    }
}
