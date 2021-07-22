<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class ProductSetsController extends Controller
{
    public function show(Request $request){
        if ($request->session()->has('countProductInCart')) {
            View::share('countProductInCart', $request->session()->get('countProductInCart', ''));
        }
        $aryProduct = Product::where('id_loaisp', 4)->paginate(10);
        $user = Auth::user() ?? '';
        return view('user.layout.ProductSets',['aryProduct'=>$aryProduct,'user'=>$user]);
    }
}
