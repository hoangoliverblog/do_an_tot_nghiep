<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class userController extends Controller
{
    public function index(){

        $pr_new = Product::paginate(5);

        $sp_nb = Product::cursor()->filter(function ($pr) {
            return $pr->price < 30000;
        });
        return view('user.layout.home',['listsp'=>$pr_new, 'listsp_nb'=>$sp_nb]);
    }
    public function sanpham($id){
        return $id;
        //return view('user.layout.sanpham');
    }
}