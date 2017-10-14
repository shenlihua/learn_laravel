<?php

namespace App\Http\Requests;


class LoginVolidator extends BaseVolidator
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'verify' => 'required|captcha',
            'account' => 'required|between:4,10',
            'password' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'account.required' => '账号必需输入!',
            'account.between' => '账号长度在4-10个字符之间!',
            'password.required' => '密码必需输入!',
            'verify.required' => '验证码必需输入!',
            'verify.captcha' => '请输入正确的验证码!',
        ];
    }


}
