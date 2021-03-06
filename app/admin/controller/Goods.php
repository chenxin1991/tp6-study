<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\Goods as GoodsModel;

class Goods extends BaseController
{
    public function index()
    {
        $where = [];
        $name = input('name');
        if ($name) {
            $where[] = ['name', 'like', "%$name%"];
        }
        $cid = input('cid');
        if ($cid) {
            $where[] = ['cid', '=', $cid];
        }
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $data = GoodsModel::with('category')->where($where)->page($pageNo, $pageSize)->order('cid,sort')->select()->toArray();
        $count = GoodsModel::where($where)->count();
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
        $price = input('price');
        $cid = input('cid');
        $sort = input('sort');
        $image_url = input('image_url');
        $goods = new GoodsModel;
        $goods->name = $name;
        $goods->price = $price;
        $goods->cid = $cid;
        $goods->sort = $sort;
        $goods->image_url = $image_url;
        $goods->save();

    }

    public function edit($id)
    {
        $goods = GoodsModel::find($id);
        $name = input('name');
        $price = input('price');
        $cid = input('cid');
        $sort = input('sort');
        $image_url = input('image_url');
        $goods->name = $name;
        $goods->price = $price;
        $goods->cid = $cid;
        $goods->sort = $sort;
        $goods->image_url = $image_url;
        $goods->save();
    }

    public function del($id)
    {
        GoodsModel::destroy($id);
    }
}