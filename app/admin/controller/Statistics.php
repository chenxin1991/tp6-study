<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\Db;

class Statistics extends BaseController
{
    public function telephone()
    {
        $where = '';
        $name = input('name');
        if (!empty($name)) {
            $where .= " and name like '%".$name."%' ";
        }
        $orderDate = input('orderDate');
        if (!empty($orderDate) && !empty($orderDate[0]) && !empty($orderDate[1])) {
            $where .= " and (resident_order.create_time between '$orderDate[0] 00:00:00' and '$orderDate[1] 23:59:59')";
        }
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $sql = "SELECT admin.name,count(*) AS totalCount, 
                SUM(CASE WHEN orderStatus>=4 THEN 1 ELSE 0 END) completedCount,
                SUM(CASE WHEN (orderStatus>=1 and orderStatus<=3) THEN 1 ELSE 0 END) ongoingCount,
                SUM(CASE WHEN orderStatus=-1  THEN 1 ELSE 0 END) cancelCount,
                SUM(totalCost) AS totalCost, 
                SUM(CASE WHEN orderStatus>=4 THEN totalCost ELSE 0 END) completedCost,
                SUM(CASE WHEN (orderStatus>=1 and orderStatus<=3) THEN totalCost ELSE 0 END) ongoingCost,
                SUM(CASE WHEN orderStatus=-1  THEN totalCost ELSE 0 END) cancelCost
                from resident_order,admin where operator > 0 and admin.id = operator $where group by operator limit " . ($pageNo - 1) * $pageSize . "," . $pageSize;
        $data = Db::query($sql);
        foreach ($data as $key => $value) {
            $data[$key]['key'] = $key;
        }
        $count = count($data);
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $data,
                'pageNo' => $pageNo,
                'pageSize' => $pageSize,
                'totalCount' => $count,
                'totalPage' => (int)($count / $pageSize) + 1
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

    public function partner()
    {
        $where = '';
        $name = input('name');
        if (!empty($name)) {
            $where .= " and name like '%".$name."%' ";
        }
        $orderDate = input('orderDate');
        if (!empty($orderDate) && !empty($orderDate[0]) && !empty($orderDate[1])) {
            $where .= " and (resident_order.create_time between '$orderDate[0] 00:00:00' and '$orderDate[1] 23:59:59')";
        }
        $pageNo = input("pageNo/d");
        $pageSize = input("pageSize/d");
        $sql = "SELECT leader.name,count(*) AS totalCount,
                SUM(CASE WHEN orderStatus>=4 THEN 1 ELSE 0 END) completedCount,
                SUM(CASE WHEN (orderStatus>=1 and orderStatus<=3) THEN 1 ELSE 0 END) ongoingCount,
                SUM(CASE WHEN orderStatus=-1  THEN 1 ELSE 0 END) cancelCount,
                SUM(totalCost) AS totalCost, 
                SUM(CASE WHEN orderStatus>=4 THEN totalCost ELSE 0 END) completedCost,
                SUM(CASE WHEN (orderStatus>=1 and orderStatus<=3) THEN totalCost ELSE 0 END) ongoingCost,
                SUM(CASE WHEN orderStatus=-1  THEN totalCost ELSE 0 END) cancelCost
                from resident_order,leader where leader > 0 and leader.id = leader $where group by leader limit " . ($pageNo - 1) * $pageSize . "," . $pageSize;
        $data = Db::query($sql);
        foreach ($data as $key => $value) {
            $data[$key]['key'] = $key;
        }
        $count = count($data);
        $result = [
            'code' => 200,
            'message' => '',
            'result' => [
                'data' => $data,
                'pageNo' => $pageNo,
                'pageSize' => $pageSize,
                'totalCount' => $count,
                'totalPage' => (int)($count / $pageSize) + 1
            ],
            'timestamp' => time()
        ];
        return json($result);
    }

}