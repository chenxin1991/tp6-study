<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2020/9/8
 * Time: 19:22
 */

namespace app\api\controller\user;

use app\BaseController;
use app\models\ResidentOrder as orderModel;
use app\models\Leader as LeaderModel;

class Index extends BaseController
{
    public function detail()
    {
        $isDriver = false;
        // 当前用户信息
        $userInfo = request()->user;
        // 订单总数
        $model = new OrderModel;
        $orderCount = [
            'confirmed' => $model->getCount($userInfo['mobile'], 'confirmed'),
            'dispatch' => $model->getCount($userInfo['mobile'], 'dispatch'),
            'start' => $model->getCount($userInfo['mobile'], 'start'),
            'complete' => $model->getCount($userInfo['mobile'], 'complete'),
            'comment' => $model->getCount($userInfo['mobile'], 'comment')
        ];
        $leader = LeaderModel::where('phone', $userInfo->mobile)->find();
        if ($leader) {
            $isDriver = true;
            $driverOrderCount = [
                'start' => $model->getDriverOrderCount($leader->id, 'start'),
                'complete' => $model->getDriverOrderCount($leader->id, 'complete')
            ];
            return json([
                'code' => 1,
                'data' => [
                    'userInfo' => $userInfo,
                    'orderCount' => $orderCount,
                    'isDriver' => $isDriver,
                    'driverOrderCount' => $driverOrderCount
                ],
                'msg' => 'success'
            ]);
        }

        return json([
            'code' => 1,
            'data' => [
                'userInfo' => $userInfo,
                'orderCount' => $orderCount,
                'isDriver' => $isDriver
            ],
            'msg' => 'success'
        ]);
    }
}