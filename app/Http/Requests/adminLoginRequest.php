<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|min:9|max:30|email:rfc,dns',
            'password'=>'required|min:8|max:50'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            'email.min'=>'Email có độ dài từ 9 đến 30 kí tự',
            'email.max'=>'Email có độ dài từ 9 đến 30 kí tự',
            'email.email'=>'Định dạng nhập vào có dạng abc@gmail.com',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu dài hơn 8 kí tự',
            'password.max'=>'Mật khẩu ngắn hơn 30 kí tự',
        ];
    }
}
