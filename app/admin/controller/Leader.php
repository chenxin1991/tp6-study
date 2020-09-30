<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\Leader as LeaderModel;

class Leader extends BaseController
{
    public function index()
    {
        $name = input('name');
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = LeaderModel::where('name', 'like', '%'.$name.'%')->page($pageNo, $pageSize)->select()->toArray();
        $count = LeaderModel::where('name', 'like', '%'.$name.'%')->count();
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
        $phone = input('phone');
        $leader = new LeaderModel;
        $leader->name = $name;
        $leader->phone = $phone;
        $leader->save();
    }

    public function edit($id)
    {
        $leader = LeaderModel::find($id);
        $name = input('name');
        $phone = input('phone');
        $leader->name = $name;
        $leader->phone = $phone;
        $leader->save();
    }

    public function del($id)
    {
        LeaderModel::destroy($id);
    }
}