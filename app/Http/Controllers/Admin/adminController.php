<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\adminLoginRequest;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Comment;
use App\Models\hoadon;
use App\Models\xeploai;
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
        $lus = Product::where('soluong','<','100')->paginate(10);
        if(Auth::check())
        {  
         view()->share('user', Auth::user());
        }
        //Tổng quan người dùng
        $date = new DateTime('now', new DateTimezone('Asia/Ho_Chi_Minh'));
        $dateMonth = $date->modify('-1 month');
        $dateYear = new DateTime('now', new DateTimezone('Asia/Ho_Chi_Minh'));
        $dateYear = $dateYear->modify('-1 year');
        $dateDay = new DateTime('now', new DateTimezone('Asia/Ho_Chi_Minh'));
        $dateDay = $dateDay->modify('-1 Day');
        $sumUser = DB::table('users')->count() ?? 0;
        $sumUserNoneActive = DB::table('users')->where('status','=','noneactive')->count() ?? 0;
        $sumUserAddNewByMonth = DB::table('users')->where('created_at','>',$dateMonth)->count() ?? 0;
        //Tổng quan giỏ hàng
        $productMoreLike  = DB::table('carts')->pluck('name');
        foreach ($productMoreLike as $key => $item) {
           $aryProductMoreLike[] = $item;
        }
        $aryCountValue = array_count_values($aryProductMoreLike);
        $numberLike = max($aryCountValue) ;
        foreach($aryCountValue as $key => $value)
        {
            if($numberLike === $value)
            {
                $nameProductLike = $key; // loại sản phẩm đc yêu thích nhất
            }
        }
        $sumProductNotPay = DB::table('carts')->where('status','=','chưa thanh toán')->count() ?? 0; 

        $productOfMonth  = DB::table('carts')->where('created_at','>',$dateMonth)->pluck('name');
        foreach ($productOfMonth as $key => $item) {
           $sumProductOfMonth[] = $item;
        }
        $aryCountProductOfMonth = array_count_values($aryProductMoreLike);
        $numberProductOfMonth = max($aryCountProductOfMonth) ;
        foreach($aryCountProductOfMonth as $key => $value)
        {
            if($numberProductOfMonth === $value)
            {
                $nameProductOfMonth = $key; // sản phẩm của tháng
            }
        }


        $productViewCount  = DB::table('products')->pluck('viewcount');
        foreach ($productViewCount as $key => $item) {
           $aryProductViewCount[] = $item;
        }
        $numberViewCountMax = max($aryProductViewCount);
        $numberViewCountMin = min($aryProductViewCount);
        $sumProductViewCountMax = array_sum($aryProductViewCount);
        $nameProductViewCountMax = DB::table('products')->where('viewcount','=',$numberViewCountMax)->pluck('name');
        $nameProductViewCountMin = DB::table('products')->where('viewcount','=',$numberViewCountMin)->pluck('name');
        foreach ($nameProductViewCountMax as $item) {
            $aryNameProductViewCountMax[] = $item;
         }
         foreach ($nameProductViewCountMin as $item) {
            $aryNameProductViewCountMin[] = $item;
         }
        //Doanh thu
        $sumRevenue = DB::table('hoadons')->pluck('sum');
        foreach ($sumRevenue as $item) {
            $aryRevenue[] = $item;
         }
        $sumRevenue = array_sum($aryRevenue) ?? ""; // tổng doanh thu

        $sumRevenueDay = DB::table('hoadons')->where('created_at','>',$dateDay)->pluck('sum');
        $sumByDay = [];
        foreach ($sumRevenueDay as $item) {
            $sumByDay[] = $item;
        }
        $sumRevenueByDay = array_sum($sumByDay) ?? ""; // ngày gần nhất
        
        $sumRevenueMonth = DB::table('hoadons')->where('created_at','>',$dateMonth)->pluck('sum');
        foreach ($sumRevenueMonth as $item) {
            $sumByMonth[] = $item;
        }
        $sumRevenueByMonth = array_sum($sumByMonth) ?? ""; // tháng gần nhất

        $sumRevenueYear = DB::table('hoadons')->where('created_at','>',$dateYear)->pluck('sum');
        foreach ($sumRevenueYear as $item) {
            $sumByYear[] = $item;
        }
        $sumRevenueByYear = array_sum($sumByYear) ?? ""; // năm gần nhất
        

        $numberOfUnpaidOrders   = DB::table('hoadons')->where('status','=','chưa thanh toán')->count();
        $topHoaDon   = hoadon::where('status','=','chưa thanh toán')->paginate(2);
        $quantitySoldInTheMonth = DB::table('hoadons')
                                    ->where('created_at','>',$dateMonth)
                                    ->where('status','=','đã thanh toán')
                                    ->get() ?? [];
        if(count($quantitySoldInTheMonth) == 0)
        {
            $sumInTheMonth = 0;
        }else{
            foreach($quantitySoldInTheMonth as $key => $value)
                {
                    $sumQuantitySoldInTheMonth[] = $value;
                }
            $sumInTheMonth = array_sum($sumQuantitySoldInTheMonth);
        }
        
        //Đánh giá sản phẩm
        $maxProductReviews = DB::table('xeploais')->pluck('level');
        foreach ($maxProductReviews as $item) {
            $aryProductReviews[] = $item;
         }
        $idProductReviewsMax = max($aryProductReviews);
        $idProductReviewsMin = min($aryProductReviews);

        $nameProductReviewsMax = xeploai::where('level','=',$idProductReviewsMax);
        $nameProductReviewsMin = xeploai::where('level','=',$idProductReviewsMin);
        $topProduct            = Product::paginate(5);
        //Bình luận khách hàng
        $sumComment = DB::table('comments')->where('created_at','>',$dateMonth)->count();
        $sumGoodComment = DB::table('comments')->where('created_at','>',$dateMonth)->where('content', 'like', 'tot%')->count();
        $commentView = Comment::paginate(3);
        //ary -> view dashboarh
        $aryToView = [
            'sumUser'               =>$sumUser,
            'sumUserNoneActive'     =>$sumUserNoneActive,
            'sumUserAddNewByMonth'  =>$sumUserAddNewByMonth,
            'nameProductLike'       => $nameProductLike,
            'sumProductNotPay'      => $sumProductNotPay,
            'nameProductOfMonth'    => $nameProductOfMonth,
            'sumRevenue'     => $sumRevenue,
            'numberOfUnpaidOrders'  => $numberOfUnpaidOrders,
            'sumInTheMonth'         => $sumInTheMonth,
            'idProductReviewsMax'   => $idProductReviewsMax,
            'idProductReviewsMin'   => $idProductReviewsMin,
            'sumComment'            => $sumComment,
            'sumGoodComment'        => $sumGoodComment,
            'nameProductViewCountMax' => $aryNameProductViewCountMax,
            'nameProductViewCountMin' => $aryNameProductViewCountMin,
            'sumProductViewCountMax'  => $sumProductViewCountMax,
            'sumRevenueByDay'       => $sumRevenueByDay,
            'sumRevenueByMonth'     => $sumRevenueByMonth,
            'sumRevenueByYear'      => $sumRevenueByYear,

        ];
        return view('admin.layout.home',[
            'aryToView'=>$aryToView,
            'lus'=>$lus,
            'commentView'=>$commentView,
            'nameProductReviewsMax'  => $nameProductReviewsMax,
            'nameProductReviewsMin'  => $nameProductReviewsMin,
            'topProduct'             => $topProduct,
            'topHoaDon'              => $topHoaDon
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
