<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class TrademarkController extends Controller
{
    public function show(){
        $aryProduct = Product::paginate(10)->where('id_loaisp', 5);
        return view('user.layout.trademark',['aryProduct'=>$aryProduct]);
    }
}
