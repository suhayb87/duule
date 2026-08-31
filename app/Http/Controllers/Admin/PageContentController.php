<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageContentController extends Controller
{
    public function index(): Response
    {
        $contents = PageContent::orderBy('page')
            ->orderBy('section')
            ->get()
            ->groupBy('page');

        return Inertia::render('Admin/Content/Index', [
            'contents' => $contents,
        ]);
    }

    public function edit(PageContent $content): Response
    {
        return Inertia::render('Admin/Content/Edit', [
            'content' => $content,
        ]);
    }

    public function update(Request $request, PageContent $content): RedirectResponse
    {
        $validated = $request->validate([
            'title'   => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image'   => ['nullable', 'url'],
        ]);

        $content->update($validated);

        return redirect()
            ->route('admin.content.index')
            ->with('success', 'Content updated successfully.');
    }
}