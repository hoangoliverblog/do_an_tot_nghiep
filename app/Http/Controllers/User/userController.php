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
        $comment    = Comment::where('pr_id',$id)->paginate(2);
        $product = DB::table('products')->find($id);
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        return view('user.layout.sanpham',['user'=>$user,'product' => $product,'comment'=>$comment]);
    }
    public function searchAllProductByName(Request $request){
        $keyword = $request->searchProduct;
        $aryResult = DB::table('products')->where('name', 'like', $keyword.'%')->get();
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
                'email.required'=>'Email kh??ng ???????c ????? tr???ng',
                'email.min'=>'Email c?? ????? d??i t??? 9 ?????n 30 k?? t???',
                'email.max'=>'Email c?? ????? d??i t??? 9 ?????n 30 k?? t???',
                'email.email'=>'?????nh d???ng nh???p v??o c?? d???ng abc@gmail.com',
                'password.required'=>'M???t kh???u kh??ng ???????c ????? tr???ng',
                'password.min'=>'M???t kh???u d??i h??n 8 k?? t???',
                'password.max'=>'M???t kh???u ng???n h??n 30 k?? t???',
                're_password.required'=>'M???t kh???u kh??ng ???????c ????? tr???ng',
                're_password.min'=>'M???t kh???u d??i h??n 8 k?? t???',
                're_password.max'=>'M???t kh???u ng???n h??n 30 k?? t???',
                'name.required'=>'T??n ng?????i d??ng kh??ng ???????c ????? tr???ng',
                'name.min'=>'T??n ng?????i d??ng l???n h??n 3 k?? t???',
                'name.max'=>'T??n ng?????i d??ng ng???n h??n 30 k?? t???',
                'phone.numeric' => 'S??? ??i???n tho???i c?? ?????nh d???ng ki???u s???',
                'phone.required' => 'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng',
                'phone.min' => 'S??? ??i???n tho???i c?? ????? d??i t???i thi???u l?? 10 ch??? s???'
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {    
                if($request->password !== $request->re_password)
                {
                        return view('user.layout.Resgister')->with('message_pass','Nh???p l???i m???t kh???u ch??a ch??nh x??c');
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
                'otp.required'=>'M?? OTP ??ang tr???ng',
                'otp.numeric' => 'S??? ??i???n tho???i c?? ?????nh d???ng ki???u s???'
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
                return redirect()->route('user.Login')->with('thongbao','T??i kho???n ho???c m???t kh???u kh??ng ch??nh x??c');    
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
                            'comment.required' => 'B???n ch??a nh???p b??nh lu???n n??o'
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
                            'comment.required' => 'B???n ch??a nh???p b??nh lu???n n??o',
                            'email.rfc,
                            dns'    => 'Sai ?????nh d???ng email',
                            'email.required'   => 'Vui l??ng nh???p email ????? ????nh gi?? s???n ph???m!'
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
                'status'     => 'Ch??? x??? l??',
                'created_at' =>  new DateTime(),
                'updated_at' => new DateTime()
            ]);
            return redirect()->route('user.showCart',['id'=>$id]);

        }
            
    }

    public function showBuy($id,Request $request){
        $product = DB::table('products')->find($id);
        $user = Auth::user() ?? '';
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        return view('user.layout.showBuy',['product'=>$product,'user'=>$user]);
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
                    'email.required'=>'Email kh??ng ???????c ????? tr???ng',
                    'email.min'=>'Email c?? ????? d??i t??? 9 ?????n 30 k?? t???',
                    'email.max'=>'Email c?? ????? d??i t??? 9 ?????n 30 k?? t???',
                    'email.email'=>'?????nh d???ng nh???p v??o c?? d???ng abc@gmail.com',
                    'address.required'=>'?????a ch??? kh??ng ???????c ????? tr???ng',
                    'city.required'=>'M???t kh???u kh??ng ???????c ????? tr???ng',
                    'phone.numeric' => 'S??? ??i???n tho???i c?? ?????nh d???ng ki???u s???',
                    'phone.required' => 'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng',
                    'phone.min' => 'S??? ??i???n tho???i c?? ????? d??i t???i thi???u l?? 10 ch??? s???',
                    'zipcode.numeric'   => 'M?? b??u ??i???n l?? ki???u s???'
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
                    'status'     => 'ch??a thanh to??n',
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
                    "status"   =>  'ch??a thanh to??n'
                ];

                $this->sendBill($email,$purchasedProductData);

                return redirect()->back()->with('msg','M???t email chi ti???t mua h??ng ???? ???????c g???i t???i b???n.');    
            }
        }
       
    }

    public function showCart($id ,Request $request)
    {
        $user = Auth::user() ?? '';
        if(Auth::check())
        {
            $cart = DB::table('carts')->where('user_id', '=', Auth::user()->id)->where('status','=','Ch??? x??? l??')->get();
        }
        else
        {
            $cart = DB::table('carts')->where('user_id', '=', $request->session()->get('name'))->where('status','=','Ch??? x??? l??')->get();
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
        $vnp_TmnCode    = "NXE8898T"; //M?? website t???i VNPAY 
        $vnp_HashSecret = "LTEAYKMCSVGRUPYMESCFCCSCJGUZOLYD"; //Chu???i b?? m???t
        $vnp_Url        = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TxnRef     = $_POST['order_id'].'@'.$stringId; //M?? ????n h??ng. Trong th???c t??? Merchant c???n insert ????n h??ng v??o DB v?? g???i m?? n??y sang VNPAY
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
                    'status' => '???? thanh to??n'
                ]);
            }
        }

        return view('payment.pay_return');
    }
}