<?php
namespace app\models;

use think\Model;

class Goods extends Model
{
    protected $json = ['image_url'];

    protected $jsonAssoc = true;

    public function category()
    {
        return $this->belongsTo(Category::class,'cid')->bind(['category' => 'name']);
    }

}