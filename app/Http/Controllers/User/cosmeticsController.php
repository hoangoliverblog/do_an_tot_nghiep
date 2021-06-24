<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class cosmeticsController extends Controller
{
    public function show(Request $request){
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        $aryProduct = Product::paginate(10)->where('id_loaisp', 3);
        $user = Auth::user() ?? '';
        return view('user.layout.cosmetics',['aryProduct'=>$aryProduct,'user'=>$user]);
    }
}
