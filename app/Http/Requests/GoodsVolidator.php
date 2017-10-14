<?php

namespace App\Http\Requests;


class GoodsVolidator extends BaseVolidator
{
    //图片长度
    const MIN_IMG_LIMIT = 1;
    const MAX_IMG_LIMIT = 5;
    public function rules()
    {
        return [
            'cate_id'  =>  'required|integer|min:1',
            'name'  =>  'required|between:1,50',
            'intro'  =>  'between:0,200',
            'in_money'  =>  'required|numeric',
            'price'  =>  'required|numeric',
            'stock'  =>  'integer',
            'sort'  =>  'integer',
            'images' => 'array|between:'.self::MIN_IMG_LIMIT.','.self::MAX_IMG_LIMIT,
        ];
    }

    public function messages()
    {
        return [
            'cate_id.required' => '请选择商品分类',
            'cate_id.min' => '请选择商品分类-',
            'name.required' =>  '分类名称必需填写',
            'name.between' =>  '分类名称长度在1-50之间',
            'intro.between' =>  '分类名称长度在0-200之间',
            'in_money.required' =>  '进货价必需填写',
            'in_money.numeric' =>  '进货价必需为数字',
            'price.required' =>  '售价必需填写',
            'price.numeric' =>  '售价必需为数字',
            'stock.integer' =>  '库存必需是整数',
            'sort.integer' =>  '排序必需是整数',
            'images.required' =>  '必需上传商品图片',
            'images.between' =>  '图片数量必需在'.self::MIN_IMG_LIMIT.'--'.self::MAX_IMG_LIMIT.'张',

        ];
    }
}
