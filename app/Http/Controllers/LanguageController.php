<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function swithcLang(Request $request)
    {
        $lang = $request->lang;
        if(array_key_exists($lang, Config::get('languages')))
        {
            Session::put('applocale', $lang);
        }
        return true;
    }
}
