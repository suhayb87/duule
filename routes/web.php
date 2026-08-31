<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controller\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    $raw = \App\Models\PageContent::where('page', 'about')->get();

    $content = [
        'story'         => $raw->firstWhere('section', 'story')?->content,
        'story_title'   => $raw->firstWhere('section', 'story')?->title,
        'mission'       => $raw->firstWhere('section', 'mission')?->content,
        'mission_title' => $raw->firstWhere('section', 'mission')?->title,
        'values'        => $raw->firstWhere('section', 'values')?->content,
        'values_title'  => $raw->firstWhere('section', 'values')?->title,
    ];

    return Inertia::render('About', compact('content'));
})->name('about');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

/*
|--------------------------------------------------------------------------
| Admin CRM Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('rooms', RoomController::class)->except(['show']);
        Route::resource('bookings', AdminBookingController::class)->except(['create', 'store']);
        Route::resource('gallery', AdminGalleryController::class)->except(['show']);
        Route::resource('content', PageContentController::class)->only(['index', 'edit', 'update']);
        Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
       Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
    ->name('bookings.update-status');
    Route::patch('messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])
    ->name('messages.toggle-read');
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });

/*
|--------------------------------------------------------------------------
| Breeze / Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';