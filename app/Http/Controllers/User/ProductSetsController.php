<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductSetsController extends Controller
{
    public function show(){
        $aryProduct = Product::paginate(10)->where('id_loaisp', 4);
        return view('user.layout.ProductSets',['aryProduct'=>$aryProduct]);
    }
}
