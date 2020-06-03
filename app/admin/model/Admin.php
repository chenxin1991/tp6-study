<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function role()
    {
        return $this->belongsTo(Role::class)->bind(['rolename' => 'name']);
    }

    public function getStatusAttr($value)
    {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常'];
        return $status[$value];
    }
}