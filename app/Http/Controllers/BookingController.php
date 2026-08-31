<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class BookingController extends Controller
{
    public function index(): Response
    {
        $rooms = Room::where('is_active', true)
            ->orderBy('price_per_night')
            ->get();

        return Inertia::render('Booking/Index', [
            'rooms' => $rooms,
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_id'      => ['required', 'exists:rooms,id'],
            'guest_name'   => ['required', 'string', 'max:255'],
            'guest_email'  => ['required', 'email', 'max:255'],
            'guest_phone'  => ['nullable', 'string', 'max:30'],
            'check_in'     => ['required', 'date', 'after_or_equal:today'],
            'check_out'    => ['required', 'date', 'after:check_in'],
            'guests'       => ['required', 'integer', 'min:1'],
            'notes'        => ['nullable', 'string', 'max:1000'],
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Basic capacity check
        if ($validated['guests'] > $room->capacity) {
            return back()->withErrors([
                'guests' => "This room can only accommodate up to {$room->capacity} guests.",
            ]);
        }

        $checkIn  = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights   = $checkIn->diffInDays($checkOut);

        $totalPrice = $room->price_per_night * $nights;

        Booking::create([
            'room_id'      => $room->id,
            'guest_name'   => $validated['guest_name'],
            'guest_email'  => $validated['guest_email'],
            'guest_phone'  => $validated['guest_phone'] ?? null,
            'check_in'     => $checkIn,
            'check_out'    => $checkOut,
            'guests'       => $validated['guests'],
            'total_price'  => $totalPrice,
            'status'       => 'pending',
            'notes'        => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('booking')
            ->with('success', 'Your booking request has been received! We will contact you shortly to confirm.');
    }
}
