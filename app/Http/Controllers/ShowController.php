<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function showHomePage()
    {
        // جلب المحتوى حيث section = 'about-us'
        $aboutUs = Setting::where('section', 'about-us')->first();

        if (!$aboutUs) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }

        // جلب المحتوى حيث section = 'vision'
        $vision = Setting::where('section', 'vision')->first();

        if (!$vision) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }

        // جلب المحتوى حيث section = 'message'
        $message = Setting::where('section', 'message')->first();

        if (!$message) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }

        // جلب المحتوى حيث section = 'targetgroup'
        $targetgroup = Setting::where('section', 'target group')->first();

        if (!$targetgroup) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }

        return view('welcome', compact('aboutUs', 'targetgroup', 'message', 'vision'));
    }

    public function showAbout_usPage()
    {
        // جلب المحتوى حيث section = 'about-us'
        $aboutUs = Setting::where('section', 'about-us')->first();
        if (!$aboutUs) {
            return response()->json([
                'message' => 'Content not found',
                'data' => null
            ], 404);
        }
        return view('about-us', compact('aboutUs'));
    }

    public function showEventsPage(){
        $events = Event::where('is_published', '1')
        ->orderByDesc('id')
        ->get();  
        return view('events' , compact('events'));
    }
}
