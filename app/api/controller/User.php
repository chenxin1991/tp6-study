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

    public function decodePhone()
    {
        $token = input('token');
        $encryptedData = input('encryptedData');
        $iv = input('iv');
        $sessionKey = Cache::get($token)['session_key'];
        $open_id = Cache::get($token)['openid'];
        $pc = new WXBizDataCrypt('wxfeb7e646e470417e', $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );
        $model = UserModel::where('open_id', $open_id)->find();
        if ($errCode == 0) {
            $model->mobile = json_decode($data,true)['phoneNumber'];
            $model->save();
            return json(['code' => 1, 'data' => $data, 'msg' => 'success']);
        } else {
            print($errCode . "\n");
        }
    }

}
