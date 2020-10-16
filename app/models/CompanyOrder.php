<?php

namespace app\models;

use app\admin\model\Admin;
use think\Model;

class CompanyOrder extends Model
{
    public function manager()
    {
        return $this->belongsTo(Admin::class, 'manager_id')->bind(['managerName' => 'name']);
    }

    public function leader()
    {
        return $this->belongsTo(Admin::class, 'leader_id')->bind(['leaderName' => 'name']);
    }
}