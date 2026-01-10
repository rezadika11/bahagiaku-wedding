<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user as the creator
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $this->command->info('Creating 100 clients...');

        $names = [
            'Budi Santoso',
            'Ani Wijaya',
            'Citra Dewi',
            'Dedi Kurniawan',
            'Eka Putri',
            'Fajar Rahman',
            'Gita Sari',
            'Hadi Pratama',
            'Indah Permata',
            'Joko Widodo',
            'Kartika Sari',
            'Lina Marlina',
            'Made Suryani',
            'Nanda Pratama',
            'Oki Setia',
            'Putri Ayu',
            'Qori Amalia',
            'Rudi Hartono',
            'Siti Nurhaliza',
            'Tono Sugiarto',
            'Umar Bakri',
            'Vina Panduwinata',
            'Wawan Setiawan',
            'Xena Warrior',
            'Yudi Latif',
            'Zahra Amani',
            'Agus Salim',
            'Bella Saphira',
            'Candra Malik',
            'Dina Mariana',
        ];

        $cities = [
            'Jakarta',
            'Bandung',
            'Surabaya',
            'Yogyakarta',
            'Semarang',
            'Medan',
            'Makassar',
            'Palembang',
            'Tangerang',
            'Depok',
            'Bekasi',
            'Bogor',
            'Malang',
            'Solo',
            'Denpasar',
        ];

        for ($i = 1; $i <= 100; $i++) {
            $name = $names[array_rand($names)] . ' ' . $i;
            $city = $cities[array_rand($cities)];

            Client::create([
                'name' => $name,
                'phone' => '08' . rand(1000000000, 9999999999),
                'email' => strtolower(str_replace(' ', '', $name)) . '@example.com',
                'address' => 'Jl. ' . $city . ' No. ' . rand(1, 100) . ', ' . $city,
                'notes' => 'Client dari ' . $city . ' - Data seeder #' . $i,
                'created_by' => $user->id,
            ]);
        }

        $this->command->info('✓ 100 clients created successfully!');
    }
}
