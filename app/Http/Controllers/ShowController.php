<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function showHomePage()
    {
        // جلب المحتوى حيث section = 'about-us'
        $aboutUs = Setting::where('section', 'about-us')->first();


        // جلب المحتوى حيث section = 'vision'
        $vision = Setting::where('section', 'vision')->first();


        // جلب المحتوى حيث section = 'message'
        $message = Setting::where('section', 'message')->first();


        // جلب المحتوى حيث section = 'targetgroup'
        $targetgroup = Setting::where('section', 'target group')->first();

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

    public function showEventsPage()
    {
        $events = Event::where('is_published', '1')
            ->orderByDesc('id')
            ->get();
        return view('events', compact('events'));
    }

    public function showSectionsPage()
    {
        $sections = Section::with('services')->get();

        return view('sections', compact('sections'));
    }


    public function showServicesPage($id)
    {
        $services = Service::where('section_id', $id)->get();

        return view('services', compact('services'));
    }

    public function showServicesDetailesPage($id)
    {
        $service = Service::with('articles')->findOrFail($id);

        return view('servicesdetailes', compact('service'));
    }

    public function showArticlePage($id)
    {
        $article = Article::where('id' , $id )->get();

        return view('article', compact('article'));
    }
}
