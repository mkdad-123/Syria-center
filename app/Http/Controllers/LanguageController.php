<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
public function change(Request $request)
{
    $request->validate(['lang' => 'required|in:ar,en']);
    $locale = $request->input('lang');

    Cookie::queue(Cookie::make('lang', $locale, 60*24*365, '/', null, false, false, false, 'Lax'));
    app()->setLocale($locale);

    return response()->json(['ok' => true, 'lang' => $locale]);
}
}
