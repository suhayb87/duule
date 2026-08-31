<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_per_night',
        'capacity',
        'total_rooms',
        'amenities',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'capacity'        => 'integer',
        'total_rooms'     => 'integer',
        'amenities'       => 'array',
        'is_active'       => 'boolean',
    ];

    // Relationships
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Helpers
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}