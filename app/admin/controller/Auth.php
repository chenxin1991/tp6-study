<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Admin;
use think\facade\Cache;

class Auth extends BaseController
{
    public function login()
    {
        if (request()->isPost()) {
            $username = input("username");
            $password = input("password");
            $user = Admin::where([
                'username' => $username,
                'password' => md5($password)
            ])->find();
            if ($user) {
                $str = md5(uniqid(md5(microtime(true)), true));
                $token = sha1($str . $user->username);
                Cache::set($token, ['user_id' => $user->id, 'username' => $user->username, 'name' => $user->name], 60 * 60 * 24);
                $data = [
                    'code' => 200,
                    'message' => '',
                    'result' => [
                        'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/jZUIxmJycoymBprLOUbT.png",
                        'id' => $user->id,
                        'token' => $token,
                        'username' => $user->username
                    ],
                    'timestamp' => time()
                ];
                return json($data);
            }
        }
    }

    public function logout()
    {
        $token = request()->token;
        Cache::delete($token);
        $data = ['message' => '注销成功', 'result' => ['isLogin' => true], 'timestamp' => time()];
        return json($data);
    }
}
