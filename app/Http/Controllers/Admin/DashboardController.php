<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Room;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_rooms'      => Room::count(),
                'active_rooms'     => Room::active()->count(),
                'total_bookings'   => Booking::count(),
                'pending_bookings' => Booking::pending()->count(),
                'confirmed_bookings' => Booking::confirmed()->count(),
                'unread_messages'  => ContactMessage::unread()->count(),
                'gallery_images'   => GalleryImage::count(),
            ],
            'recentBookings' => Booking::with('room')
                ->latest()
                ->take(5)
                ->get(),
            'recentMessages' => ContactMessage::latest()
                ->take(5)
                ->get(),
        ]);
    }
}