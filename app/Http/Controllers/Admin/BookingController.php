<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BookingController extends Controller
{
    public function index(Request $request): Response
    {
        $bookings = Booking::with('room')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => $bookings,
            'filters'  => $request->only('status'),
        ]);
    }

    public function show(Booking $booking): Response
    {
        $booking->load('room');

        return Inertia::render('Admin/Bookings/Show', [
            'booking' => $booking,
        ]);
    }

    public function edit(Booking $booking): Response
    {
        $booking->load('room');

        return Inertia::render('Admin/Bookings/Edit', [
            'booking' => $booking,
            'rooms'   => Room::active()->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'room_id'      => ['required', 'exists:rooms,id'],
            'guest_name'   => ['required', 'string', 'max:255'],
            'guest_email'  => ['required', 'email'],
            'guest_phone'  => ['nullable', 'string', 'max:30'],
            'check_in'     => ['required', 'date'],
            'check_out'    => ['required', 'date', 'after:check_in'],
            'guests'       => ['required', 'integer', 'min:1'],
            'status'       => ['required', 'in:pending,confirmed,cancelled,completed'],
            'notes'        => ['nullable', 'string'],
            'total_price'  => ['required', 'numeric', 'min:0'],
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Booking status updated successfully.');
    }
}