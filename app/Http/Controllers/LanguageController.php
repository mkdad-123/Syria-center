<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $request->validate([
            'lang' => 'required|in:en,ar'
        ]);

        Session::put('locale', $request->lang);
        App::setLocale($request->lang);

        return response()->json(['success' => true]);
    }
}