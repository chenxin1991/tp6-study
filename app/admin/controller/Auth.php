<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Admin;

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
                $data = [
                    'code' => 200,

                    'message' => '',

                    'result' => [

                        'avatar' => "https://gw.alipayobjects.com/zos/rmsportal/jZUIxmJycoymBprLOUbT.png",

                        'createTime' => 1497160610259,

                        'creatorId' => "admin",

                        'deleted' => 0,

                        'id' => "F6e1005C-f7BB-CE7B-1fD5-3bc7F6bc1bc8",

                        'lang' => "zh-CN",

                        'lastLoginIp' => "27.154.74.117",

                        'lastLoginTime' => 1534837621348,

                        'name' => "Edward Martin",

                        'password' => "",

                        'roleId' => "admin",

                        'status' => 1,

                        'telephone' => "",

                        'token' => "4291d7da9005377ec9aec4a71ea837f",

                        'username' => "admin",

                    ],

                    'timestamp' => time()

                ];
                return json($data);
            }
        }
    }
}
