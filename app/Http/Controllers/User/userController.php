<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailGetOtp;
use App\Mail\SendMailToUser;
use Illuminate\Http\Request;
use App\Models\Product;
use App\User;
use App\Models\Cart;
use App\Models\Comment;
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
        $user = Auth::user() ?? '';
        return view('user.layout.home',['listsp'=>$pr_new, 'listsp_nb'=>$sp_nb,'user'=>$user]);
    }
    public function sanpham($id){
        $user = Auth::user() ?? '';
        $comment = DB::table('comments')->where('pr_id',1)->paginate(2);
        $product = DB::table('products')->find($id);

        return view('user.layout.sanpham',['user'=>$user,'product' => $product,'comment'=>$comment]);
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

                $userMail = $request->email;
                $OTP = rand(100000,999999);
                $request->session()->put('user_email',$userMail);
                User::insert([
                    'name'=>$request->name,
                    'role_id'=>2,
                    'image'=>$request->name ?? 'trong',
                    'address'=>$request->address ?? 'trong', 
                    'phone'=>$request->phone,
                    'gioitinh'=>$request->gioitinh ?? 'trong',
                    'otp'=> $OTP,
                    'status'=>'noneactive',
                    'email'=>$request->email,
                    'password'=>password_hash($request->re_password,PASSWORD_DEFAULT),
                    'created_at' => new DateTime()
                ]);

                $this->sendEmail($userMail,$OTP);

                return redirect()->route('user.checkOtp');    
            }
        }
    }


    public function checkOtp(Request $request){
        $a = $request->session()->get('user_email');
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
                $userEmail =  $request->session()->get('user_email') ?? '';

                $users = DB::table('users')->where([
                    ['email', '=', $userEmail ],
                    ['otp', '=', $request->otp],
                ])->get();

                if(1 <= count($users))
                {
                    DB::table('users')->where('email',$userEmail)->update([
                        'status' => 'active'
                    ]);
                    return redirect('/');    
                }
                return redirect()->route("user.checkOtp");    
                
            }
        }
    }

    public function checkLogin(Request $request){
        if($request->isMethod('HEAD'))
        {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active']))
            {
                return redirect('/');
                
            }else
            {
                return redirect()->route('user.Login')->with('thongbao','Tài khoản hoặc mật khẩu không chính xác');    
            }   
            
        }
    }
    public function Logout(){
        Auth::logout();
        return redirect('/');  
    }
    public function comment($id,Request $request){
        if ($request->isMethod('HEAD')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'comment'  => 'required',
                    'email'=>'email:rfc,dns',
                ],
                [
                    'comment.required' => 'Bạn chưa nhập bình luận nào',
                    'email.rfc,dns' => 'Sai định dạng email'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else 
            {

                if(isset(Auth::user()->email))
                {
                    $comment = $request->comment  ?? '';
                    DB::table('comments')->insert([
                        'user_id' => Auth::user()->id,
                        'pr_id' => $id,
                        'content' => $comment,
                        'created_at' =>  new DateTime(),
                        'updated_at' => new DateTime()
                    ]);
                    return redirect()->back();
                }
                
                $user_id = $request->email ?? '';
                $comment = $request->comment  ?? '';
                DB::table('comments')->insert([
                    'user_id' => 10,
                    'pr_id' => $id,
                    'content' => $comment,
                    'created_at' =>  new DateTime(),
                    'updated_at' => new DateTime()
                ]);
                return redirect()->back();
                
            }
        }
    }


    public function addToCart($id,Request $request){
        
        if($request->isMethod('HEAD'))
        {
            $findProduct = DB::table('products')->find($id);
            $hd_id = $findProduct->id ?? 1;
            $name = $findProduct->name;
            $soluong = $request->soluong;
            $sum = $request->soluong * $findProduct->price;
            echo $sum ;
            DB::table('carts')->insert([
                'hd_id'      => $hd_id,
                'name'       => $name,
                'soluong'    => $soluong,
                'sum'        => $sum,
                'status'     => 'Chờ xử lý',
                'created_at' =>  new DateTime(),
                'updated_at' => new DateTime()
            ]);
            return redirect()->back();

        }

    }
    
    
}