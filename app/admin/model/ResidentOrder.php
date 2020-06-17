<?php

namespace app\admin\model;

use think\Model;

class ResidentOrder extends Model
{
    protected $json = ['cars', 'routes', 'onoffs', 'larges'];

    protected $jsonAssoc = true;

    public function user()
    {
        return $this->belongsTo(Admin::class, 'operator')->bind(['username' => 'name']);
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