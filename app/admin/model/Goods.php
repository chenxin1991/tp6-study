<?php
namespace app\admin\model;

use think\Model;

class Goods extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class,'cid')->bind(['category' => 'name']);
    }

}