<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'  => 'required|min:3|max:30',
          'role_id' => 'required',
          'email'=>'required|min9|max:30|email:rfc,dns',
          'password'=> 'required|min:8|max:50'
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
            'role_id.required'=>'loại tài khoản là bắt buộc',
            'name.required'=>'Tên người dùng không được để trống',
            'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
            'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
        ];
    }
}
