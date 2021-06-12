<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailGetOtp;
use App\Mail\SendMailToUser;
use Illuminate\Http\Request;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    public function index(){

        $pr_new = Product::paginate(5);

        $sp_nb = Product::cursor()->filter(function ($pr) {
            return $pr->price < 30000;
        });
        return view('user.layout.home',['listsp'=>$pr_new, 'listsp_nb'=>$sp_nb]);
    }
    public function sanpham($id){
        return $id;
        //return view('user.layout.sanpham');
    }
    public function userLogin(){
        
        return view('user.layout.userLogin');
    }
    public function Resgister(){
        
        return view('user.layout.Resgister');
    }

    public function createUser(Request $request)
    {    

        if($request->isMethod('HEAD'))
        {
            $validator = Validator::make($request->all(),[
                'name'  => 'required|min:3|max:30',
                'email'=>'required|min:9|max:30|email:rfc,dns',
                'phone' => 'required|min:3|numeric',
                'password'=> 'required|min:8|max:50',
                're_password'=> 'required|min:8|max:50',
            ],
            [
                'email.required'=>'Email không được để trống',
                'email.min'=>'Email có độ dài từ 9 đến 30 kí tự',
                'email.max'=>'Email có độ dài từ 9 đến 30 kí tự',
                'email.email'=>'Định dạng nhập vào có dạng abc@gmail.com',
                'password.required'=>'Mật khẩu không được để trống',
                'password.min'=>'Mật khẩu dài hơn 8 kí tự',
                'password.max'=>'Mật khẩu ngắn hơn 30 kí tự',
                're_password.required'=>'Mật khẩu không được để trống',
                're_password.min'=>'Mật khẩu dài hơn 8 kí tự',
                're_password.max'=>'Mật khẩu ngắn hơn 30 kí tự',
                'name.required'=>'Tên người dùng không được để trống',
                'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
                'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
                'phone.numeric' => 'Số điện thoại có định dạng kiểu số',
                'phone.required' => 'Số điện thoại không được để trống',
                'phone.min' => 'Số điện thoại có độ dài tối thiểu là 10 chữ số'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    
                if($request->password !== $request->re_password)
                {
                        return view('user.layout.Resgister')->with('message_pass','Nhập lại mật khẩu chưa chính xác');
                }
                // $userMail = $request->email;
                // $OTP = rand(100000,999999);

                // User::insert([
                //     'name'=>$request->name,
                //     'role_id'=>2,
                //     'image'=>$request->name ?? 'trong',
                //     'address'=>$request->address ?? 'trong', 
                //     'phone'=>$request->phone,
                //     'gioitinh'=>$request->gioitinh ?? 'trong',
                //     'otp'=> $OTP,
                //     'status'=>'noneactive',
                //     'email'=>$request->email,
                //     'password'=>password_hash($request->re_password,PASSWORD_DEFAULT),
                //     'created_at' => new DateTime()
                // ]);

                // $this->sendEmail($userMail,$OTP);

                return redirect()->route('user.checkOtp');    
            }
        }
    }


    public function checkOtp(){
        return view('user.layout.codeOtp');
    }
    
    public function activeAcount(Request $request){
        if($request->isMethod('HEAD'))
        {
            $validator = Validator::make($request->all(),[
                'otp'  => 'required|numeric'
            ],
            [
                'otp.required'=>'Mã OTP đang trống',
                'otp.numeric' => 'Số điện thoại có định dạng kiểu số'
            ]);
            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    

                return redirect('/');    
            }
        }
    }
    
}