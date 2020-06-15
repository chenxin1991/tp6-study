<?php

namespace app\admin\controller;

use app\BaseController;
use app\admin\model\AppletConfig as AppletConfigModel;

class AppletConfig extends BaseController
{
    public function detail($id)
    {
        $applet_cofig = AppletConfigModel::find($id);
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $applet_cofig,
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

    public function edit($id)
    {
        $config = AppletConfigModel::find($id);
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
        $config->discount1 = $discount1;
        $config->discount2 = $discount2;
        $config->add_ratio1 = $add_ratio1;
        $config->add_ratio2 = $add_ratio2;
        $config->carry_remark = $carry_remark;
        $config->floor_remark = $floor_remark;
        $config->distance_remark = $distance_remark;
        $config->onoff_remark = $onoff_remark;
        $config->large_remark = $large_remark;
        $config->remark = $remark;
        $config->save();
    }

}