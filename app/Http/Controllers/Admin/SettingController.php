<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/Settings/Edit', [
            'settings' => [
                'hotel_address' => Setting::get('hotel_address'),
                'hotel_phone'   => Setting::get('hotel_phone'),
                'hotel_email'   => Setting::get('hotel_email'),
                'hotel_hours'   => Setting::get('hotel_hours'),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hotel_address' => ['required', 'string'],
            'hotel_phone'   => ['required', 'string'],
            'hotel_email'   => ['required', 'email'],
            'hotel_hours'   => ['required', 'string'],
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Hotel contact info updated.');
    }
}