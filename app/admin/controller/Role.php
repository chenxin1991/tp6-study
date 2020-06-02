<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\Db;
use app\admin\model\Role as RoleModel;

class Role extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = Db::name('role')->where('name', 'like', '%'.$name.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = Db::name('role')->where('name', 'like', '%'.$name.'%')->count();
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
        $role = new RoleModel;
        $role->name = $name;
        $role->save();

    }

    public function edit($id)
    {
        $role = RoleModel::find($id);
        $name = input('name');
        $role->name = $name;
        $role->save();
    }

    public function del($id)
    {
        RoleModel::destroy($id);
    }
}