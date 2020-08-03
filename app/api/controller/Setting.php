<?php

namespace app\api\controller;

use app\BaseController;
use app\models\Setting as SettingModel;


class Setting extends BaseController
{
    public function index($id)
    {
        $setting = SettingModel::find($id);
        $result = [
            'status' => 200,
            'msg' => 'ok',
            'data' => $setting
        ];
        return json($result);
    }
}