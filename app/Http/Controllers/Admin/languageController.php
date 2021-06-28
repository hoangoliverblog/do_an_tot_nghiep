<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Application;
class languageController extends Controller
{
    public function index(Application $App,$language)
    {
        if(isset($language))
        {
            $App->setLocale($language);
        }
        return redirect()->back();
        

    }
}
