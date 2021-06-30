<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class languageController extends Controller
{
    public function index(Request $request, $language)
    {
        if(isset($language))
        {
            $request->session()->put('language', $language);
        }
        // dd($request->session()->get('language', 'en'));
        return redirect()->back();
        

    }
}
