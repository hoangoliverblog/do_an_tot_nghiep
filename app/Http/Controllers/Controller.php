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
}
