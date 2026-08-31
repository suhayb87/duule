<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function index(): Response
    {
        $images = GalleryImage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Gallery', [
            'images' => $images,
        ]);
    }
}