<?php

return [
    'event' => [
        'title' => 'Our Wedding',
        'date' => '2026-07-18',
        'time' => '18:00',
        'timezone' => 'Asia/Jakarta',
        'venue_name' => 'Whistler Garden',
        'venue_address' => 'Jl HR Jl. Rasuna Said, Salembaran, Kosambi, Tangerang Regency, Banten 15214, Indonesia',
        'general_info' => 'Join us for a celebration of love. Dinner and dancing to follow.',
    ],
    'events' => [
        [
            'title' => 'Holy Matrimony',
            'venue_name' => 'The Westin Jakarta',
            'venue_room' => 'Denpasar Room',
            'address_line1' => 'Jl. H. R. Rasuna Said Kav C-22A,',
            'address_line2' => 'South Jakarta',
            'date' => '2025-12-07',
            'time' => '11:30',
            'timezone' => 'Asia/Jakarta',
            'maps_url' => 'https://www.google.com/maps/search/?api=1&query=The+Westin+Jakarta+Denpasar+Room',
        ],
        [
            'title' => 'Wedding Reception',
            'venue_name' => 'The Westin Jakarta',
            'venue_room' => 'Java Ballroom',
            'address_line1' => 'Jl. H. R. Rasuna Said Kav C-22A,',
            'address_line2' => 'South Jakarta',
            'date' => '2025-12-07',
            'time' => '18:30',
            'timezone' => 'Asia/Jakarta',
            'maps_url' => 'https://www.google.com/maps/search/?api=1&query=The+Westin+Jakarta+Java+Ballroom',
        ],
    ],
    'media' => [
        'hero_image_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1480&auto=format&fit=crop',
        'video_file_url' => null,
        'video_embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
        'map_embed_url' => 'https://www.google.com/maps?q=Grand+Ballroom+Jakarta&output=embed',
        'gallery' => [
            ['url' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=1200&auto=format&fit=crop', 'alt' => 'Engagement'],
            ['url' => 'https://images.unsplash.com/photo-1518600506278-4e8ef466b010?q=80&w=1200&auto=format&fit=crop', 'alt' => 'Bride & Groom'],
            ['url' => 'https://images.unsplash.com/photo-1495567720989-cebdbdd97913?q=80&w=1200&auto=format&fit=crop', 'alt' => 'Ceremony'],
            ['url' => 'https://images.unsplash.com/photo-1519225421980-715cb0216a56?q=80&w=1200&auto=format&fit=crop', 'alt' => 'Reception'],
            ['url' => 'https://placehold.co/1200x800?text=Engagement', 'alt' => 'Engagement'],
            ['url' => 'https://placehold.co/1200x800?text=Bride+%26+Groom', 'alt' => 'Bride & Groom'],
            ['url' => 'https://placehold.co/1200x800?text=Ceremony', 'alt' => 'Ceremony'],
            ['url' => 'https://placehold.co/1200x800?text=Reception', 'alt' => 'Reception'],
        ],
    ],
    'calendar' => [
        'duration_minutes' => 180,
    ],
    'gifts' => [
        ['label' => 'Gift Registry', 'url' => 'https://example.com/registry'],
        ['label' => 'Online Giving', 'url' => 'https://example.com/giving'],
    ],
    'custom_actions' => [
        ['label' => 'Hotel Booking', 'url' => 'https://example.com/hotel'],
        ['label' => 'Dress Code', 'url' => 'https://example.com/dresscode'],
        ['label' => 'Photo Gallery', 'url' => 'https://example.com/gallery'],
        ['label' => 'Contact Us', 'url' => 'mailto:hello@example.com'],
    ],
    'languages' => ['en', 'id'],
];
