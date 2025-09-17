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

        Cookie::queue(Cookie::make('lang', $locale, 60 * 24 * 365, '/', null, false, false, false, 'Lax'));

        // ارجع نفس المسار لكن مع تبديل أول سيغمنت (اللغة)
        $current = url()->previous(); // أو $request->headers->get('referer')
        $parsed  = parse_url($current);
        $path    = trim($parsed['path'] ?? '/', '/'); // ex: en/home/about-us
        $parts   = $path ? explode('/', $path) : [];
        if (!empty($parts) && in_array($parts[0], ['ar', 'en'])) {
            $parts[0] = $locale;
        } else {
            array_unshift($parts, $locale);
        }
        $newPath = '/' . implode('/', $parts);
        $newUrl  = ($parsed['scheme'] ?? $request->getScheme()) . '://' . ($parsed['host'] ?? $request->getHost()) . $newPath;

        return response()->json(['redirect' => $newUrl]);
    }
}
