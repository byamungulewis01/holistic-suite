<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    // switch language
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            session()->put('applocale', $lang);
        }
        return redirect()->back();
    }   
}
