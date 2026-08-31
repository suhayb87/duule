<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function index(): Response
    {
        $images = GalleryImage::orderBy('sort_order')->paginate(20);

        return Inertia::render('Admin/Gallery/Index', [
            'images' => $images,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Gallery/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'image_path'  => ['required', 'url'],
            'alt_text'    => ['nullable', 'string', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        GalleryImage::create($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Image added to gallery.');
    }

    public function edit(GalleryImage $gallery): Response
    {
        return Inertia::render('Admin/Gallery/Edit', [
            'image' => $gallery,
        ]);
    }

    public function update(Request $request, GalleryImage $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'image_path'  => ['required', 'url'],
            'alt_text'    => ['nullable', 'string', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $gallery->update($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery image updated.');
    }

    public function destroy(GalleryImage $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Image removed from gallery.');
    }
}