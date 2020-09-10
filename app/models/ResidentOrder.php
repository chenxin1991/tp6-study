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

    public function getOrderStatusAttr($value)
    {
        $status = [-1 => '已取消', 0 => '待确认', 1 => '待派单', 2 => '待开工', 3 => '待完工', 4 => '待评价', 5 => '已完成'];
        return $status[$value];
    }

    public function getPayStatusAttr($value)
    {
        $status = [0 => '未支付', 1 => '已支付'];
        return $status[$value];
    }

    /**
     * 获取我的订单总数
     * @param $user_id
     * @param string $type
     * @return int|string
     */
    public function getCount($user_id, $type = 'all')
    {
        // 筛选条件
        $filter = [];
        // 订单数据类型
        switch ($type) {
            case 'all':
                break;
            case 'confirmed':
                $filter['orderStatus'] = 0;
                break;
            case 'dispatch':
                $filter['orderStatus'] = 1;
                break;
            case 'start':
                $filter['orderStatus'] = 2;
                break;
            case 'complete':
                $filter['orderStatus'] = 3;
                break;
            case 'comment':
                $filter['orderStatus'] = 4;
                break;
        }
        return $this->where('user_id', '=', $user_id)
            ->where($filter)
            ->count();
    }

    public function getList($user_id, $type = 'all')
    {
        // 筛选条件
        $filter = [];
        // 订单数据类型
        switch ($type) {
            case 'all':
                break;
            case 'confirmed':
                $filter['orderStatus'] = 0;
                break;
            case 'dispatch':
                $filter['orderStatus'] = 1;
                break;
            case 'start':
                $filter['orderStatus'] = 2;
                break;
            case 'complete':
                $filter['orderStatus'] = 3;
                break;
            case 'comment':
                $filter['orderStatus'] = 4;
                break;
        }
        return $this->where('user_id', '=', $user_id)
            ->where($filter)
            ->order(['create_time' => 'desc'])
            ->select()->toArray();
    }

}