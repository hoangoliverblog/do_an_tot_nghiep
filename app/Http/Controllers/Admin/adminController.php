<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\adminLoginRequest;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
class adminController extends Controller
{

    public function __construct()
    {
        
    }
    public function login(){
        if(Auth::check())
        {
            return redirect()->route('Admin.show');
        }else{
            return view('admin.master.login');
        }
        
    }

    public function show(){
        
        if(Auth::check())
        {  
         view()->share('user', Auth::user());
        }
        $date = new DateTime();

        $date = $date->modify('-1 month');

        $sumUser = DB::table('users')->count() ?? 0;
        $sumUserNoneActive = DB::table('users')->where('status','=','noneactive')->count() ?? 0;
        $sumUserAddNewByMonth = DB::table('users')->where('created_at','>',$date)->count() ?? 0;
    
        $sumProductNotPay = DB::table('carts')->where('status','=','chưa thanh toán')->count() ?? 0;
        return view('admin.layout.home',[
            'sumUser'               =>$sumUser,
            'sumUserNoneActive'     =>$sumUserNoneActive,
            'sumUserAddNewByMonth'  =>$sumUserAddNewByMonth,

            ]);
    }

    public function checklogin(adminLoginRequest $adminLoginRequest){
        if($adminLoginRequest->isMethod('post'))
        {
            if(Auth::attempt(['email' => $adminLoginRequest->email, 'password' => $adminLoginRequest->password,'role_id'=>'1']))
            {
               return redirect()->route('Admin.show');

            }else{
                
                return view('admin.master.login')->with('thongbao','Tài khoản hoặc mật khẩu không chính xác');
            }
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('Admin/login');
    }
    public function showPasswordRetrieval(){
        return view('admin.layout.showPasswordRetrieval');
    }
    public function passwordRetrieval(Request $request){

        if($request->isMethod('POST'))
        {
            $validator = Validator::make($request->all(),[
                'email'=>'required|min:9|max:30|email:rfc,dns'
            ],
            [
                'email.required'=>'Email không được để trống',
                'email.min'=>'Email có độ dài từ 9 đến 30 kí tự',
                'email.max'=>'Email có độ dài từ 9 đến 30 kí tự',
                'email.email'=>'Định dạng nhập vào có dạng abc@gmail.com'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    
                $email = $request->email;
                $OTP   = rand(100000,999999);
                $numberUser = DB::table('users')->where('email','=',$email)->count();
                if(1 <= $numberUser)
                {
                    $this->sendEmail($email,$OTP);
                    DB::table('users')->where('email','=',$email)->update([
                        'otp' => $OTP
                    ]);
                    $request->session()->put('nameEmail', $email);
                    return redirect()->route('Admin.showCodeOtp');
                }
            }   
        }
        
    }

    public function showCodeOtp(){
        return view('admin.layout.codeOtp');
    }

    public function checkOtpGetPassword(Request $request){

        if($request->isMethod('POST'))
        {
            $validator = Validator::make($request->all(),[
                'otp'=>'required|min:6|max:10'
            ],
            [
                'otp.required'=>'otp không được để trống',
                'otp.min'=>'otp có độ dài từ 6 đến 10 kí tự',
                'otp.max'=>'otp có độ dài từ 6 đến 10 kí tự'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    
               $email = $request->session()->get('nameEmail');
               $randomPass = implode($this->RandomString());
               $result = (int)DB::table('users')->where('email','=',$email)->where('otp','=',$request->otp)->count();
               if(1 <= $result)
               {
                   DB::table('users')->where('email','=',$email)->update([
                       'password' => password_hash($randomPass,PASSWORD_DEFAULT),
                   ]);
                   $this->sendMailGetPassword($email,$randomPass);
                   DB::table('users')->where('email','=',$email)->update([
                    'otp' => rand(100000,999999),
                ]);
                   return redirect()->route('Admin.login')->with('updatePassword','Mật khẩu mới đã được gửi tới email của bạn, vui lòng kiểm tra lại!');
               }else
               {
                   return redirect()->back()->with('msg','Mã bạn nhập chưa đúng, vui lòng thử lại');
               }
            }   
        }
    }
}
