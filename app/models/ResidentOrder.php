<?php

namespace app\models;

use app\admin\model\Admin;
use app\admin\model\Leader;
use think\Model;

class ResidentOrder extends Model
{
    protected $json = ['cars', 'routes', 'goods'];

    protected $jsonAssoc = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'operator')->bind(['adminname' => 'name']);
    }

    public function leader()
    {
        return $this->belongsTo(Leader::class, 'leader')->bind(['leadername' => 'name']);
    }

    public function getSourceAttr($value)
    {
        $status = [0 => '来电', 1 => '上门', 2 => '小程序'];
        return $status[$value];
    }

    public function getOrderStatusAttr($value)
    {
        $status = [0 => '待受理', 1 => '待派单', 2 => '待开工', 3 => '待完成', 4 => '待评价', 5 => '已关闭', 6 => '已取消'];
        return $status[$value];
    }

    public function getPayStatusAttr($value)
    {
        $status = [0 => '未支付', 1 => '已支付'];
        return $status[$value];
    }
}