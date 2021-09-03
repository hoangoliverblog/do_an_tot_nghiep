<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use DateTime;
// use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
// use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginUrl()
    {
        
        return Socialite::driver('google')->redirect();
    }

    public function loginCallback(Request $request)
    { 
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                $request->session()->flash('toastr', [
                    'type'      => 'success',
                    'message'   => 'Login thành công !'
                ]);
                return redirect('/');
            } else {
                $newPassword = rand(100000, 999999);
                $newUser = User::create([
                    'name' => $user->name,
                    'role_id' => 2,
                    'image' => $user->name,
                    'phone' => '',
                    'gioitinh' => '',
                    'otp' => $newPassword,
                    'status' => 'active',
                    'email' => $user->email,                    
                    'email_verified_at' => '',
                    'password' => password_hash($newPassword,PASSWORD_DEFAULT),
                    'created_at' => new DateTime()
                ]);

                Auth::login($newUser);
                // Mail::to($user->email)->send(new SendPasswordLoginGoogle($user->name, $newPassword));
                $request->session()->flash('toastr', [
                    'type'      => 'success',
                    'message'   => 'Tạo tài khoản và login thành công !'
                ]);
                // return redirect()->intended('/');
                return redirect('/');
            }
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }
}
