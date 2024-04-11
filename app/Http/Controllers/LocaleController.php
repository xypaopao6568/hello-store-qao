<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale($lang)
    {
        if (in_array($lang, ['en', 'vi'])) {
            session(['locale' => $lang]);
        }
        return back();
    }
}
