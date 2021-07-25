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
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    public function index(Request $request){

        $pr_new = Product::paginate(5);

        $sp_nb = Product::cursor()->filter(function ($pr) {
            return $pr->price < 100000;
        });
        $productUserId = Auth::user()->id ?? $request->session()->get('name');
        $countProductInCart = DB::table('carts')->where('user_id','=',$productUserId)->count();
        $request->session()->put('countProductInCart',$countProductInCart);

        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        $user = Auth::user() ?? '';
        return view('user.layout.home',['listsp'=>$pr_new, 'listsp_nb'=>$sp_nb,'user'=>$user,'countProductInCart'=>$countProductInCart]);
    }

    public function sanpham($id,Request $request){
        $user = Auth::user() ?? '';
        // $comment = DB::table('comments')->where('pr_id',$id)->paginate(2);
        $comment          = Comment::where('pr_id',$id)->paginate(2);
        $product          = DB::table('products')->find($id);
        $numberViewCount  = $product->viewcount;
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        $sessionCountView = $request->session()->has('sessionCountView'.$id);
        if(false === $sessionCountView)
        {
            $request->session()->push('sessionCountView'.$id, session_id());
            $getSessionCountView = $request->session()->has('sessionCountView'.$id);
            if(true === $getSessionCountView)
            {
                DB::table('products')->where('id',$id)->update(['viewcount'=> $numberViewCount + 1]);
            }
        }
        $newProduct = Product::paginate(3);
        return view('user.layout.sanpham',['user'=>$user,'product' => $product,'comment'=>$comment,'newProduct'=>$newProduct]);
    }
    
    public function searchAllProductByName(Request $request){
        $keyword = $request->searchProduct;
        $aryResult = DB::table('products')->where('name', 'like', $keyword.'%')->orwhere('producer', 'like', $keyword.'%')->get();
        // $aryResult = DB::table('products')->join('loaisanphams', function ($join) {
        //                                                                  $join->on('id_loaisp', '=', 'loaisanphams.id')
        //                                                                     ->where('loaisanphams.id', 'like', 'nước hoa%');})->get();

        return view('user.layout.searchAll',['aryResult'=> $aryResult]);
    }
    
    public function searchByPriceRange(Request $request){
        $ByPriceRangeMax = 0;
        $ByPriceRangeMin = 0;
        $getDataSearch   = (int)$request->searchByPriceRange;
        switch ($getDataSearch) {
        case 1:
            $ByPriceRangeMax = 100000 ;
            $ByPriceRangeMin = 1;
            break;
        case 2:
            $ByPriceRangeMax = 200000 ;
            $ByPriceRangeMin = 100000 ;
            break;
        case 3:
            $ByPriceRangeMax = 300000 ;
            $ByPriceRangeMin = 200000 ;
            break;
        case 4:
            $ByPriceRangeMax = 500000 ;
            $ByPriceRangeMin = 300000 ;
            break;
        case 5:
            $ByPriceRangeMax = 500000 ;
            break;
        }
        // $keyword = $request->searchProduct;
        // $aryResult = DB::table('products')->where('name', 'like', $keyword.'%')->get();
        if(0 != $ByPriceRangeMin)
        {
            $aryResult = DB::table('products')
                    ->whereBetween('price', [$ByPriceRangeMin, $ByPriceRangeMax])                    
                    ->get();
        }else
        {
            $aryResult = DB::table('products')
                    ->where('price','>',$ByPriceRangeMax)                    
                    ->get();
        }
        
        return view('user.layout.searchAll',['aryResult'=> $aryResult]);
        
    }
    public function userLogin(Request $request){
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        return view('user.layout.userLogin');
    }
    public function Resgister(Request $request){
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
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
                    DB::table('users')->where('email',$userEmail)->update([
                        'otp' => rand(100000,999999)
                    ]);
                    return redirect('/');    
                }
                return redirect()->route("user.Login");    
                
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
            if(Auth::check())
                {
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'comment'  => 'required'
                        ],
                        [
                            'comment.required' => 'Bạn chưa nhập bình luận nào'
                        ]
                    );
                }else
                {
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'comment'  => 'required',
                            'email'=>'required|email:rfc,dns',
                        ],
                        [
                            'comment.required' => 'Bạn chưa nhập bình luận nào',
                            'email.rfc,
                            dns'    => 'Sai định dạng email',
                            'email.required'   => 'Vui lòng nhập email để đánh giá sản phẩm!'
                        ]
                    );
                }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else 
            {

                if(Auth::check())
                {
                    $comment = $request->comment  ?? '';
                    DB::table('comments')->insert([
                        'user_id' => Auth::user()->id,
                        'pr_id' => $id,
                        'content' => $comment,
                        'emailIfNotLogin' => Auth::user()->email,
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
                    'emailIfNotLogin' => $request->email,
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
            if(!Auth::check())
            {
                $request->session()->put('name',session()->getId()); 
                $userIdIfNotLogin = session()->getId();
            }
            
            $findProduct = DB::table('products')->find($id);
            $hd_id = 1;
            $name = $findProduct->name;
            $soluong = $request->soluong;
            $sum = $request->soluong * $findProduct->price;
            $insert =DB::table('carts')->insert([
                'hd_id'      => $hd_id,
                'user_id'    => Auth::user()->id ?? $userIdIfNotLogin,
                'name'       => $name,
                'soluong'    => $soluong,
                'sum'        => $sum,
                'status'     => 'Chờ xử lý',
                'created_at' =>  new DateTime(),
                'updated_at' => new DateTime()
            ]);
            return redirect()->route('user.showCart',['id'=>$id]);

        }
            
    }

    public function showBuy($id,Request $request){
        $newProduct = Product::paginate(3);
        $product = DB::table('products')->find($id);
        $user = Auth::user() ?? '';
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        return view('user.layout.showBuy',['product'=>$product,'user'=>$user,'newProduct'=>$newProduct]);
    }
    public function buyProduct($id , Request $request){
    
        if($request->isMethod('HEAD'))
        {
            if(!isset(Auth::user()->name))
            {
                $validator = Validator::make($request->all(),[
                    'email'     =>'required|min:9|max:30|email:rfc,dns',
                    'phone'     => 'required|min:3|numeric',
                    'address'   => 'required',
                    'city'      => 'required',
                    'zipcode'   => 'numeric'
                ],
                [
                    'email.required'=>'Email không được để trống',
                    'email.min'=>'Email có độ dài từ 9 đến 30 kí tự',
                    'email.max'=>'Email có độ dài từ 9 đến 30 kí tự',
                    'email.email'=>'Định dạng nhập vào có dạng abc@gmail.com',
                    'address.required'=>'Địa chỉ không được để trống',
                    'city.required'=>'Mật khẩu không được để trống',
                    'phone.numeric' => 'Số điện thoại có định dạng kiểu số',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.min' => 'Số điện thoại có độ dài tối thiểu là 10 chữ số',
                    'zipcode.numeric'   => 'Mã bưu điện là kiểu số'
                ]);
            }
            else
            {
                $validator = Validator::make($request->all(),[
                ],
                [
                ]);
            }
            

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            { 

                $pr_id       = $id ;
                $user_id     = Auth::user()->id ?? 10;
                $email       = $request->email ?? Auth::user()->email;
                $phone       = $request->phone ?? Auth::user()->phone;
                $address     = $request->address ?? Auth::user()->address;
                $city        = $request->city ?? '';
                $product     = DB::table('products')->find($id);
                $zipcode     = $request->zipcode;
                $sum         = $product->price * (int)$request->soluong;
                DB::table('hoadons')->insert([
                    'pr_id'      => $pr_id,
                    'user_id'    => $user_id,
                    'email'      => $email,
                    'phone'      => $phone,
                    'address'    => $address,
                    'city'       => $city,
                    'zipcode'    => $zipcode,
                    'sum'        => $sum,
                    'status'     => 'chưa thanh toán',
                    'created_at' =>  new DateTime(),
                    'updated_at' => new DateTime()
                    ]);
                $timeBuy = new DateTime();
                $timeBuy = $timeBuy->format("Y-m-d H:i:s");
                $purchasedProductData  = [
                    "id"        =>  $product->id,
                    "name"      =>  $product->name,
                    "price"     =>  $product->price,
                    "soluong"   =>  $request->soluong,
                    "thongtin"  =>  $product->thongtin,
                    "sum"       =>  $sum,
                    "img"       =>  $product->img,
                    "sale"      =>  $product->sale,
                    "timeBuy"   =>  $timeBuy,
                    "address"   =>  $address,
                    "phone"     =>  $phone,
                    "status"   =>  'chưa thanh toán'
                ];

                $this->sendBill($email,$purchasedProductData);

                return redirect()->back()->with('msg','Một email chi tiết mua hàng đã được gửi tới bạn.');    
            }
        }
       
    }

    public function showCart($id ,Request $request)
    {
        $user = Auth::user() ?? '';
        if(Auth::check())
        {
            $cart = DB::table('carts')->where('user_id', '=', Auth::user()->id)->where('status','=','Chờ xử lý')->get();
        }
        else
        {
            $cart = DB::table('carts')->where('user_id', '=', $request->session()->get('name'))->where('status','=','Chờ xử lý')->get();
        }

        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        return view('user.layout.showCart',['data'=>$cart,'user'=>$user]);
        // return redirect()->route('user.showCart',['id'=>$id]);
    }

    public function deleteProductsInCart($id)
    {
        DB::table('carts')->where('id', '=', $id)->delete();
        return redirect()->back();
    }
    
    public function showPayMent(Request $request)
    {
        $aryProduct = $request->all() ?? [];
        unset($aryProduct['_token']);
        if($aryProduct == [])
        {
            return redirect()->back();
        }
        foreach($aryProduct as $item)
        {
            $aryItem    = explode('@',$item);
            $aryId[]    = $aryItem[1];
            $aryName[]  = $aryItem[0];
            $arySum[]      = $aryItem[2];
        }
        $sum = array_sum($arySum);
        return view('payment.form_pay',['id'=>$aryId,'name'=>$aryName,'sum'=>$sum,'nameUserIfNotLogin'=>session()->getId()]);
    }

    public function createPayment(Request $request){
        $stringId       = $request->idProductPay;
        $vnp_TmnCode    = "NXE8898T"; //Mã website tại VNPAY 
        $vnp_HashSecret = "LTEAYKMCSVGRUPYMESCFCCSCJGUZOLYD"; //Chuỗi bí mật
        $vnp_Url        = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TxnRef     = $_POST['order_id'].'@'.$stringId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo  = $_POST['order_desc'];
        $vnp_OrderName  = $_POST['order_name'];
        $vnp_Amount     = str_replace(',', '', $_POST['amount']) * 100;
        $vnp_Locale     = $_POST['language'];
        $vnp_BankCode   = $_POST['bank_code'];
        $vnp_IpAddr     = $_SERVER['REMOTE_ADDR'];
        // $aryLastExl     = explode('@',$stringId);
        // foreach($aryLastExl as $item)
        // {
            
        //     $aryIdProduct[] = trim($item);
        // }

        $inputData = [
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo ,
            "vnp_ReturnUrl" => route('user.payReturn'),
            "vnp_TxnRef" => $vnp_TxnRef
        ];       

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);   
    }

    public function payReturn(){
        $inputData = [];
        $data = $_REQUEST;
        
        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $ary = explode('@',$inputData['vnp_TxnRef']);
        foreach($ary as $item)
        {
            $aryId[] = $item;
        }
        $nameProduct = $aryId[0];
        unset($aryId[0]);
        $count = (int)count($aryId);
        unset($aryId[$count]);
        if ($inputData['vnp_ResponseCode'] == '00') {
            foreach($aryId as $id)
            {
                DB::table('carts')->where('id','=',$id)->update([
                    'status' => 'Đã thanh toán'
                ]);
            }
        }

        return view('payment.pay_return');
    }
}