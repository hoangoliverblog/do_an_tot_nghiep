<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
              
    }
    public function uploadimg(Request $request,$name_input_img,$id = null){
        
        $lsp = Product::find($id);
        if($request->hasFile($name_input_img))
        {
            $file = $request->file($name_input_img);
            $dress = public_path('img');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move($dress,$name);
        }
        else
        {
             $name = $lsp->img;
        }
        
        return $name;
    }

    public function sendEmail($email,$OTP){
        $to_name = "admin";
        $to_email = $email;
        $data = [
            "name"=>"Cloudways (sender_name)",
            "body" => "A test mail",
            "otp" => $OTP
            ];

        Mail::send('emails.email',['data' => $data], function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject("Shop mỹ phẩm 365");
        $message->from("hoang681682@gmail.com","Shop mỹ phẩm 365");
        });
    }


    public function sendBill($email,$productData){
        $to_name = "admin";
        $to_email = $email;
        $data = [
            "name"      =>$email,
            "body"      => "A test mail",
            "otp"       => '637',
            "product"    => $productData
            ];

        Mail::send('emails.sendBill',['data' => $data], function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject("Shop mỹ phẩm 365");
        $message->from("hoang681682@gmail.com","Shop mỹ phẩm 365");
        });
    }

    public function sendMailGetPassword($email,$newPass){
        $to_name = "admin";
        $to_email = $email;
        $data = [
            "name"      =>$email,
            "body"      => "A test mail",
            "otp"       => '637',
            "pass"    => $newPass
            ];

        Mail::send('emails.sendMailGetPassword',['data' => $data], function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)->subject("Shop mỹ phẩm 365");
        $message->from("hoang681682@gmail.com","Shop mỹ phẩm 365");
        });
    }

    public function RandomString()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, strlen($alphabet)-1);
            $pass[$i] = $alphabet[$n];
        }
        return $pass;
    }
   
}
