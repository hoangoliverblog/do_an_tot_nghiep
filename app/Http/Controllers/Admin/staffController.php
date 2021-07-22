<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Models\Product;
class staffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lus    = User::paginate(10);
        $user   = Auth::user();
        $staff  = DB::table('Staff')->get();
        return view('admin.layout.staff',['lus'=>$lus,'user'=>$user,'staff'=>$staff]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lus = User::paginate(10);
        $user = Auth::user();
        $staff  = DB::table('Staff')->get();
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'name'  => 'required|min:3|max:30',
                'email'=>'required|min:9|max:30|email:rfc,dns',
                'password'=> 'required|min:8|max:50',
                're_password'=> 'required|min:8|max:50',
                'phone' => 'numeric'
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
                'role_id.required'=>'loại tài khoản là bắt buộc',
                'name.required'=>'Tên người dùng không được để trống',
                'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
                'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
                'phone.numeric' => 'Số điện thoại có định dạng kiểu số'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    
                if($request->password !== $request->re_password)
                {
                        return view('admin.layout.staff',['lus'=>$lus,'user'=>$user,'staff'=>$staff])->with('message_pass','Nhập lại mật khẩu chưa chính xác');
                }
                if(isset($request->img))
                {
                    $name = $this->uploadimg($request, 'img');
                }else
                {
                    $name = 'trong';
                }
                Staff::insert([
                    'name'=>$request->name,
                    'image'=>$name ?: 'trong',
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'gioitinh'=>$request->gioitinh,
                    'otp'=> rand(100000,999999),
                    'status'=>'noneactive',
                    'email'=>$request->email,
                    'password'=>password_hash($request->re_password,PASSWORD_DEFAULT),
                    'created_at' => new DateTime()
                ]);
                return redirect()->route('staff.index');    
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lu = User::find($id);
        $user = Auth::user();
        $staff = Staff::find($id);
        $lus = Product::where('soluong','<','100')->paginate(10);
        return view('admin.layout.staffUpdate',['lu'=>$lu,'user'=>$user,'staff'=>$staff,'lus'=>$lus]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->isMethod('patch'))
        {
            
            $validator = Validator::make($request->all(),
            [
                'name'  => 'required|min:3|max:30',
                // 'email'=>'required|min:9|max:30|email:rfc,dns',
                // 'password'=> 'required|min:8|max:50',
                // 're_password'=> 'required|min:8|max:50',
                'phone' => 'numeric'
            ],
            [
                // 'email.required'=>'Email không được để trống',
                // 'email.min'=>'Email có độ dài từ 9 đến 30 kí tự',
                // 'email.max'=>'Email có độ dài từ 9 đến 30 kí tự',
                // 'email.email'=>'Định dạng nhập vào có dạng abc@gmail.com',
                // 'password.required'=>'Mật khẩu không được để trống',
                // 'password.min'=>'Mật khẩu dài hơn 8 kí tự',
                // 'password.max'=>'Mật khẩu ngắn hơn 30 kí tự',
                // 're_password.required'=>'Mật khẩu không được để trống',
                // 're_password.min'=>'Mật khẩu dài hơn 8 kí tự',
                // 're_password.max'=>'Mật khẩu ngắn hơn 30 kí tự',
                'role_id.required'=>'loại tài khoản là bắt buộc',
                'name.required'=>'Tên người dùng không được để trống',
                'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
                'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
                'phone.numeric' => 'Số điện thoại có định dạng kiểu số'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {    
                if($request->img)
                {
                    $name = $this->uploadimg($request,'img',$id);
                }else
                {
                    $lsp    = Staff::find($id);
                    $name   = $lsp->image ; 
                }
                
                DB::table('Staff')->where('id',$id)->update([
                    'name'=>$request->name,
                    'image'=>$name ?: 'trong',
                    'address'=>$request->address,
                    'status' => $request->status,
                    'phone'=>$request->phone,
                    'gioitinh'=>$request->gioitinh,
                    'updated_at' => new DateTime()
                ]);
               return redirect()->route('staff.index');    
            }
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::where('id',$id)->delete();
        return redirect()->back();
    }
}
