<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\GalleryImage;
use App\Models\PageContent;
use Illuminate\Database\Seeder;
use App\Models\Setting;


class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Rooms ----------
        $rooms = [
            [
                'name' => 'Deluxe Ocean View',
                'slug' => 'deluxe-ocean-view',
                'description' => 'Spacious room with panoramic ocean views, king-size bed, private balcony, and modern amenities.',
                'price_per_night' => 189.00,
                'capacity' => 2,
                'total_rooms' => 8,
                'amenities' => json_encode(['Ocean View', 'King Bed', 'Balcony', 'Mini Bar', 'Free WiFi', 'Air Conditioning']),
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQr_G3hCDfLL47feNKDTrXW2uBYp5oVNX_8EJVnyuTXEg&s=10',
                'is_active' => true,
            ],
            [
                'name' => 'Executive Suite',
                'slug' => 'executive-suite',
                'description' => 'Luxurious suite featuring a separate living area, work desk, and premium bathroom with rainfall shower.',
                'price_per_night' => 289.00,
                'capacity' => 3,
                'total_rooms' => 4,
                'amenities' => json_encode(['Living Area', 'King Bed', 'Work Desk', 'Rainfall Shower', 'Coffee Machine', 'Free WiFi']),
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQemJ4kIJyzrfvmkY0VgUHbSn9E0xaTsnK7-xdjZpzXwg&s',
                'is_active' => true,
            ],
            [
                'name' => 'Garden Villa',
                'slug' => 'garden-villa',
                'description' => 'Private villa surrounded by tropical gardens. Perfect for families or couples seeking privacy.',
                'price_per_night' => 349.00,
                'capacity' => 4,
                'total_rooms' => 3,
                'amenities' => json_encode(['Private Garden', 'Two Bedrooms', 'Kitchenette', 'Outdoor Shower', 'Pool Access', 'Free WiFi']),
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYCW6R9H1bXvAiQqlpLa4mJljKX3kzeSMauJcvtDuDB29vFZWDoM_8gB72&s=10',
                'is_active' => true,
            ],
            [
                'name' => 'Standard Twin Room',
                'slug' => 'standard-twin',
                'description' => 'Comfortable twin room ideal for friends or colleagues. Clean, bright, and well-equipped.',
                'price_per_night' => 129.00,
                'capacity' => 2,
                'total_rooms' => 12,
                'amenities' => json_encode(['Twin Beds', 'City View', 'Work Desk', 'Free WiFi', 'Air Conditioning']),
                'image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        // ---------- Settings ------
        
Setting::set('hotel_address', 'Coastal Road 42, Seaside Bay');
Setting::set('hotel_phone', '+1 (555) 123-4567');
Setting::set('hotel_email', 'hello@duulehotel.com');
Setting::set('hotel_hours', '24/7');

        // ---------- Gallery ----------
        $gallery = [
            ['title' => 'Infinity Pool at Sunset', 'image_path' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/31/cf/94/98/caption.jpg?w=900&h=500&s=1', 'alt_text' => 'Infinity pool', 'sort_order' => 1],
            ['title' => 'Lobby Lounge', 'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlZ8wEjDeSYeKH-SBa9oCtxasdZHBbcZ9gAoXljb0-fQ&s=10', 'alt_text' => 'Hotel lobby', 'sort_order' => 2],
            ['title' => 'Ocean View Suite', 'image_path' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=1200&q=80', 'alt_text' => 'Ocean view room', 'sort_order' => 3],
            ['title' => 'Fine Dining Restaurant', 'image_path' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200&q=80', 'alt_text' => 'Restaurant', 'sort_order' => 4],
            ['title' => 'Spa & Wellness', 'image_path' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1200&q=80', 'alt_text' => 'Spa', 'sort_order' => 5],
            ['title' => 'Beach Access', 'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXg9EsT1R1d0kCZHG1XOqfu-sEdaAXbwAdJEitV8pvJQ&s=10', 'alt_text' => 'Private beach', 'sort_order' => 6],
            ['title' => 'Garden Pathways', 'image_path' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=1200&q=80', 'alt_text' => 'Tropical gardens', 'sort_order' => 7],
            ['title' => 'Rooftop Bar', 'image_path' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80', 'alt_text' => 'Rooftop bar', 'sort_order' => 8],
        ];

        foreach ($gallery as $item) {
            GalleryImage::create($item + ['is_active' => true]);
        }

        // ---------- Page Content ----------
        $contents = [
            // Home
            ['page' => 'home', 'section' => 'hero_title', 'title' => 'Experience Luxury by the Sea', 'content' => null],
            ['page' => 'home', 'section' => 'hero_subtitle', 'title' => null, 'content' => 'Discover unparalleled comfort, breathtaking views, and world-class hospitality at our boutique beachfront hotel.'],
            ['page' => 'home', 'section' => 'welcome', 'title' => 'Welcome to Duule Luxury Hotel', 'content' => 'Nestled on a pristine stretch of coastline, Duule Luxury offers an intimate escape where modern elegance meets natural beauty. Every detail is crafted for your perfect stay.'],

            // About
            ['page' => 'about', 'section' => 'story', 'title' => 'Our Story', 'content' => 'Founded in 2018, Duule Luxury Hotel began as a vision to create a sanctuary where travelers could reconnect with nature without sacrificing luxury. What started as a small boutique property has grown into a beloved destination known for exceptional service and unforgettable experiences.'],
            ['page' => 'about', 'section' => 'mission', 'title' => 'Our Mission', 'content' => 'To provide every guest with a seamless blend of comfort, elegance, and authentic local experiences while maintaining the highest standards of sustainability and hospitality.'],
            ['page' => 'about', 'section' => 'values', 'title' => 'Our Values', 'content' => 'Excellence • Authenticity • Sustainability • Warmth • Attention to Detail'],
        ];

        foreach ($contents as $content) {
            PageContent::create($content);
        }
    }
}