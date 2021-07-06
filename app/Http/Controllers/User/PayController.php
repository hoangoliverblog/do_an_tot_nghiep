<?php

namespace App\Http\Controllers;
use App\Models\Classs;
use App\Models\Post;
use App\Models\Register;
use App\Models\Pay;
use App\Exceptions\Handler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRequire(){
        $require = Register::where("teacher_id", Auth::id())->orderBy('id', 'desc')->paginate(10);
        $payment = Pay::where('order_name', Auth::user()->name)->get(); 
        $pay = [];
        foreach($payment as $pays){
            $pay[] = $pays->post_id;
        }
        return view('pays.require_take_class', compact('require', 'pay'));
    }

    public function showPay($post_id){
        $require = Post::where('id', $post_id)->first();
        return view('pays.form_pay', compact('require'));
    }

    public function create(Request $request)
    {
        $vnp_TmnCode = "NXE8898T"; //Mã website tại VNPAY 
        $vnp_HashSecret = "LTEAYKMCSVGRUPYMESCFCCSCJGUZOLYD"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderName = $_POST['order_name'];
        $vnp_ClassId = $request->post_id;
        $vnp_Amount = str_replace(',', '', $_POST['amount']) * 100;
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo . "/" . $vnp_ClassId . "/" . $vnp_OrderName,
            "vnp_ReturnUrl" => route('pay_return'),
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

        if ($inputData['vnp_ResponseCode'] == '00') {
            $info = explode('/' , $inputData['vnp_OrderInfo']);
            $pay = new Pay;
            $pay->post_id = $info[1];
            $pay->order_id = $inputData['vnp_TxnRef'];
            $pay->order_name = $info[2];
            $pay->money = $inputData['vnp_Amount']/100;
            $pay->note = $info[0];
            $pay->vpn_response_code = $inputData['vnp_ResponseCode'];
            $pay->code_vnpay = $inputData['vnp_TransactionNo'];
            $pay->code_bank = $inputData['vnp_BankCode'];
            $pay->save();
        }

        $invoice = "There is a teacher named " . $pay->order_name . " who has just paid for the class in the system.";
        $admin = User::where('role_id', 1)->first();
        Notification::send($admin, new NewUserRegister($invoice));

        return view('pays.pay_return');
    }
}