<?php

namespace app\api\controller;

use app\BaseController;
use app\models\AppletConfig as AppletConfigModel;


class Config extends BaseController
{
    public function index($id)
    {
        $applet_cofig = AppletConfigModel::find($id);
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => $applet_cofig
        ];
        return json($result);
    }
}