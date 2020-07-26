<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\Category as CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = CategoryModel::page($pageNo, $pageSize)->select()->toArray();
        $count = CategoryModel::count();
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
        $category = new CategoryModel;
        $category->name = $name;
        $category->save();

    }

    public function edit($id)
    {
        $name = input('name');
        $category = CategoryModel::find($id);
        $category->name = $name;
        $category->save();
    }

    public function del($id)
    {
        CategoryModel::destroy($id);
    }
}