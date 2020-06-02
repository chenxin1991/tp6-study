<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\Db;
use app\admin\model\Admin as AdminModel;

class SystemUser extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = Db::name('admin')->where('username', 'like', '%'.$name.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = Db::name('admin')->where('username', 'like', '%'.$name.'%')->count();
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

    }

    public function edit()
    {

    }
}