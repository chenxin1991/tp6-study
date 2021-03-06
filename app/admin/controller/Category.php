<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\Category as CategoryModel;

class Category extends BaseController
{
    public function index()
    {
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = CategoryModel::page($pageNo, $pageSize)->order('sort')->select()->toArray();
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
        $sort = input('sort');
        $is_free = input('is_free');
        $is_upload = input('is_upload');
        $category = new CategoryModel;
        $category->name = $name;
        $category->sort = $sort;
        $category->is_free = $is_free;
        $category->is_upload = $is_upload;
        $category->save();

    }

    public function edit($id)
    {
        $name = input('name');
        $sort = input('sort');
        $is_free = input('is_free');
        $is_upload = input('is_upload');
        $category = CategoryModel::find($id);
        $category->name = $name;
        $category->sort = $sort;
        $category->is_free = $is_free;
        $category->is_upload = $is_upload;
        $category->save();
    }

    public function del($id)
    {
        CategoryModel::destroy($id);
    }
}