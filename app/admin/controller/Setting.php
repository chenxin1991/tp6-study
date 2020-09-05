<?php

namespace app\admin\controller;

use app\BaseController;
use app\models\Setting as SettingModel;

class Setting extends BaseController
{
    public function detail()
    {
        $setting = SettingModel::find(1);
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $setting,
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

    public function edit()
    {
        $setting = SettingModel::find(1);
        $discount1 = input('discount1');
        $discount2 = input('discount2');
        $add_ratio1 = input('add_ratio1');
        $add_ratio2 = input('add_ratio2');
        $carry_remark = input('carry_remark');
        $floor_remark = input('floor_remark');
        $distance_remark = input('distance_remark');
        $onoff_remark = input('onoff_remark');
        $large_remark = input('large_remark');
        $remark = input('remark');
        $setting->discount1 = $discount1;
        $setting->discount2 = $discount2;
        $setting->add_ratio1 = $add_ratio1;
        $setting->add_ratio2 = $add_ratio2;
        $setting->carry_remark = $carry_remark;
        $setting->floor_remark = $floor_remark;
        $setting->distance_remark = $distance_remark;
        $setting->onoff_remark = $onoff_remark;
        $setting->large_remark = $large_remark;
        $setting->remark = $remark;
        $setting->save();
    }

}