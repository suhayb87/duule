<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\Room;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $rooms = Room::where('is_active', true)
            ->orderBy('price_per_night')
            ->get();

        $rawContent = PageContent::where('page', 'home')->get();

        $content = [
            'hero_title'     => $rawContent->firstWhere('section', 'hero_title')?->title,
            'hero_subtitle'  => $rawContent->firstWhere('section', 'hero_subtitle')?->content,
            'welcome'        => $rawContent->firstWhere('section', 'welcome')?->content,
            'welcome_title'  => $rawContent->firstWhere('section', 'welcome')?->title,
        ];

        return Inertia::render('Home', [
            'rooms'   => $rooms,
            'content' => $content,
        ]);
    }
}