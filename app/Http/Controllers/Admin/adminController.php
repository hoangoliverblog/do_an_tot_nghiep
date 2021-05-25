<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\adminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
        return view('admin.layout.home');
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
}
