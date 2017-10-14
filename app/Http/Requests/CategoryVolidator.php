<?php

namespace App\Http\Requests;


class CategoryVolidator extends BaseVolidator
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  =>  'required|between:1,10',
            'sort'  =>  'numeric',
            'describe'  =>  'between:0,100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  '分类名称必需填写',
            'name.between' =>  '分类名称长度在1-10之间',
            'sort.number' =>  '序号只能为整数',
            'describe.between' =>  '描述字符长度只能在0-100位',

        ];
    }
}
