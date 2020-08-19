<?php
namespace app\models;

use think\Model;

class Goods extends Model
{
    protected $json = ['images'];

    protected $jsonAssoc = true;

    public function category()
    {
        return $this->belongsTo(Category::class,'cid')->bind(['category' => 'name']);
    }

}