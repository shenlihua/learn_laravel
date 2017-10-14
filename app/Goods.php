<?php

namespace App;


class Goods extends BaseModel
{
    //
    protected $table = 'goods';
    protected $primaryKey = 'id';

    //关联图片
    public function goodsImages()
    {
        return $this->hasMany('App\GoodsImages', 'goods_id')->select(['id', 'goods_id', 'path']);
    }

    //关联分类
    public function goodsCate()
    {
        return $this->belongsTo('App\Category', 'cate_id')->select(['id','name']);
    }
    //关联分类
    public function goodsBrand()
    {
        return $this->belongsTo('App\Brand', 'brand_id')->select(['id','name']);
    }
}
