<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Admin as AdminModel;

class SystemUser extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = AdminModel::with('role')->withoutField('password')->where('username', 'like', '%' . $name . '%')
            ->page($pageNo, $pageSize)->select();
        $count = AdminModel::where('username', 'like', '%' . $name . '%')->count();
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $data,
                'pageNo' => $pageNo,
                'pageSize' => $pageSize,
                'totalCount' => $count,
                'totalPage' => (int)($count / $pageSize) + 1
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

    public function add()
    {
        $name = input('name');
        $role_id = input('role_id');
        $username = input('username');
        $systemUser = new AdminModel;
        $systemUser->name = $name;
        $systemUser->role_id = $role_id;
        $systemUser->username = $username;
        $systemUser->password = md5('123456');
        $systemUser->save();
    }

    public function edit($id)
    {
        $systemUser = AdminModel::find($id);
        $name = input('name');
        $role_id = input('role_id');
        $username = input('username');
        $systemUser->name = $name;
        $systemUser->role_id = $role_id;
        $systemUser->username = $username;
        $systemUser->save();
    }
}