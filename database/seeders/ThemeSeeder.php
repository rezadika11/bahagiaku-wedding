<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating themes...');

        $themes = [
            [
                'name' => 'Classic Elegance',
                'slug' => 'classic-elegance',
                'description' => 'Timeless and sophisticated design with elegant typography',
                'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Modern Minimalist',
                'slug' => 'modern-minimalist',
                'description' => 'Clean and simple design with modern aesthetics',
                'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Romantic Garden',
                'slug' => 'romantic-garden',
                'description' => 'Floral and romantic theme with soft colors',
                'thumbnail' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Rustic Charm',
                'slug' => 'rustic-charm',
                'description' => 'Warm and cozy design with rustic elements',
                'thumbnail' => 'https://images.unsplash.com/photo-1478146896981-b80fe463b330?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Luxury Gold',
                'slug' => 'luxury-gold',
                'description' => 'Luxurious design with gold accents',
                'thumbnail' => 'https://images.unsplash.com/photo-1470229538611-16ba8c7ffbd7?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Beach Vibes',
                'slug' => 'beach-vibes',
                'description' => 'Fresh and breezy beach-themed design',
                'thumbnail' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Vintage Romance',
                'slug' => 'vintage-romance',
                'description' => 'Classic vintage style with romantic touches',
                'thumbnail' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Boho Chic',
                'slug' => 'boho-chic',
                'description' => 'Bohemian style with artistic elements',
                'thumbnail' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=700&fit=crop',
                'is_active' => true,
            ],
        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }

        $this->command->info('✓ ' . count($themes) . ' themes created successfully!');
    }
}
