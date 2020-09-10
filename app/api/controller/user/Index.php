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

class Index extends BaseController
{
    public function detail()
    {
        // 当前用户信息
        $userInfo = request()->user;
        // 订单总数
        $model = new OrderModel;
        $orderCount = [
            'confirmed' => $model->getCount($userInfo['user_id'], 'confirmed'),
            'dispatch' => $model->getCount($userInfo['user_id'], 'dispatch'),
            'start' => $model->getCount($userInfo['user_id'], 'start'),
            'complete' => $model->getCount($userInfo['user_id'], 'complete'),
            'comment' => $model->getCount($userInfo['user_id'], 'comment')
        ];
        return json([
            'code' => 1,
            'data' => [
                'userInfo' => $userInfo,
                'orderCount' => $orderCount
            ],
            'msg' => 'success'
        ]);
    }
}