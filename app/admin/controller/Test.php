<?php

namespace app\admin\controller;

use app\BaseController;

class Test extends BaseController
{
    public function index()
    {
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => [
                [
                    'id' => 1,
                    'name' => '用车',
                    'goods' => [
                        ['id' => 1, 'name' => '4.2米货车 载重2吨 长宽高4.2*2.0*1.9米', 'image' => 'http://demo.tp6.cn/uploads/goods/car1.png', 'price' => 400],
                        ['id' => 2, 'name' => '依维柯 载重1.5吨 长宽高3.8*1.9*1.8米', 'image' => 'http://demo.tp6.cn/uploads/goods/car2.png', 'price' => 300],
                        ['id' => 3, 'name' => '面包车 载重0.55吨 长宽高2.0*1.3*1.1米', 'image' => 'http://demo.tp6.cn/uploads/goods/car3.png', 'price' => 150]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => '拆装',
                    'goods' => [
                        ['id' => 4, 'name' => '2门衣柜', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 100],
                        ['id' => 5, 'name' => '桌子/餐桌', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 50],
                        ['id' => 6, 'name' => '圆筒用电热水器', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 100]
                    ]
                ],
                [
                    'id' => 3,
                    'name' => '大件',
                    'goods' => [
                        ['id' => 7, 'name' => '大理石餐桌', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 100],
                        ['id' => 8, 'name' => '跑步机', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 100]
                    ]
                ],
                [
                    'id' => 4,
                    'name' => '材料',
                    'goods' => [
                        ['id' => 9, 'name' => '纸箱', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 13],
                        ['id' => 10, 'name' => '纸箱2', 'image' => 'http://activity.crmeb.net/public/uploads/attach/2019/05/30//0eecbfbca9ebc315c2882590fd55a209.jpg', 'price' => 13]
                    ]
                ]
            ]
        ];

        return json($result);
    }

    public function avatar()
    {
        $file = request()->file('avatar');
        $savename = \think\facade\Filesystem::disk('public')->putFile('goods', $file);
        return json([
            'status' => 'done',
            'url' => $this->app->config->get('app.app_host') . 'storage/' . str_replace('\\', '/', $savename)
        ]);
    }
}