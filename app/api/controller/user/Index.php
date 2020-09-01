<?php

namespace app\api\controller\user;

use app\api\controller\BaseController;
use app\models\ResidentOrder as ResidentOrderModel;

/**
 * 个人中心主页
 * Class Index
 * @package app\api\controller\user
 */
class Index extends BaseController
{
    /**
     * 获取当前用户信息
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function detail()
    {
        // 当前用户信息
        $userInfo = $this->getUser();
        return json($this->renderSuccess(compact('userInfo')));
    }

}
