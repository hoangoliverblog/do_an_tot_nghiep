<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\role_user;
use App\User;
use App\Models\Cart;
use App\Models\Comment;
class test extends Controller
{
    public function test()
    {
        $a = User::find(1)->role_user;
        
        return view('test',['a'=>$a]);
    }
}

