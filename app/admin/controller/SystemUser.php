<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Admin as AdminModel;

class SystemUser extends BaseController
{
    public function index()
    {
        $where = [];
        $name = input('name');
        if (!empty($name)) {
            $where[] = ['username', 'like', '%' . $name . '%'];
        }
        $role_id = input('role_id');
        if (!empty($role_id)) {
            $where[] = ['role_id', '=', $role_id];
        }
        $status = input('status');
        if ($status != '') {
            $where[] = ['status', '=', $status];
        }
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = AdminModel::with('role')->withoutField('password')->where($where)
            ->page($pageNo, $pageSize)->select();
        $count = AdminModel::where($where)->count();
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
        if (AdminModel::where('username', $username)->find()) {
            return ['code' => -2, 'message' => '用户名不能重复！'];
        }
        $systemUser = new AdminModel;
        $systemUser->name = $name;
        $systemUser->role_id = $role_id;
        $systemUser->username = $username;
        $systemUser->password = md5('123456');
        if ($systemUser->save()) {
            return ['code' => 200, 'message' => '添加成功'];
        } else {
            return ['code' => -1, 'message' => '添加失败'];
        }
    }

    public function edit($id)
    {
        $systemUser = AdminModel::find($id);
        $name = input('name');
        $role_id = input('role_id');
        $username = input('username');
        if (AdminModel::where('id', '<>', $id)->where('username', $username)->find()) {
            return ['code' => -2, 'message' => '用户名不能重复！'];
        }
        $systemUser->name = $name;
        $systemUser->role_id = $role_id;
        $systemUser->username = $username;
        if ($systemUser->save()) {
            return ['code' => 200, 'message' => '修改成功'];
        } else {
            return ['code' => -1, 'message' => '修改失败'];
        }
    }

    public function disable($id)
    {
        $systemUser = AdminModel::find($id);
        $systemUser->status = 0;
        if ($systemUser->save()) {
            return ['code' => 200, 'message' => '禁用成功'];
        } else {
            return ['code' => -1, 'message' => '禁用失败'];
        }
    }

    public function enable($id)
    {
        $systemUser = AdminModel::find($id);
        $systemUser->status = 1;
        if ($systemUser->save()) {
            return ['code' => 200, 'message' => '启用成功'];
        } else {
            return ['code' => -1, 'message' => '启用失败'];
        }
    }
}