<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Invitation;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have necessary dependencies
        $user = User::first() ?? User::factory()->create();
        $themes = Theme::all();
        $clients = Client::all();

        if ($themes->isEmpty()) {
            $this->command->info('No themes found. Please run ThemeSeeder first.');
            return;
        }

        if ($clients->isEmpty()) {
            // Create some dummy clients if none exist
            $clients = Client::factory()->count(10)->create();
        }

        $faker = \Faker\Factory::create('id_ID');

        foreach ($clients as $client) {
            // Create 1-2 invitations per client
            $count = rand(1, 2);

            for ($i = 0; $i < $count; $i++) {
                $groomName = $faker->firstNameMale;
                $brideName = $faker->firstNameFemale;
                $slug = Str::slug($groomName . ' dan ' . $brideName . ' ' . Str::random(5));

                $weddingDate = $faker->dateTimeBetween('now', '+1 year');
                $theme = $themes->random();

                $invitation = Invitation::create([
                    'client_id' => $client->id,
                    'theme_id' => $theme->id,
                    'created_by' => $user->id,
                    'slug' => $slug,

                    // Groom Info
                    'groom_name' => $groomName,
                    'groom_fullname' => $groomName . ' ' . $faker->lastName,
                    'groom_father' => $faker->name('male'),
                    'groom_mother' => $faker->name('female'),
                    'groom_instagram' => '@' . Str::slug($groomName),
                    'groom_child_order' => rand(1, 5),

                    // Bride Info
                    'bride_name' => $brideName,
                    'bride_fullname' => $brideName . ' ' . $faker->lastName,
                    'bride_father' => $faker->name('male'),
                    'bride_mother' => $faker->name('female'),
                    'bride_instagram' => '@' . Str::slug($brideName),
                    'bride_child_order' => rand(1, 5),

                    // Details
                    'wedding_date' => $weddingDate,
                    'quote_text' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
                    'quote_source' => 'QS Ar-Rum: 21',

                    'status' => $faker->randomElement(['draft', 'published', 'published', 'published']), // More published
                    'is_active' => true,
                    'view_count' => rand(0, 500),

                    'published_at' => Carbon::now(),
                ]);

                // Create dummy events for this invitation
                $this->createEvents($invitation, $weddingDate, $faker);

                // Create dummy guests for this invitation
                $this->createGuests($invitation, $faker);
            }
        }
    }

    private function createEvents(Invitation $invitation, $weddingDate, $faker)
    {
        // Akad Nikah
        $invitation->events()->create([
            'event_type' => 'akad',
            'event_name' => 'Akad Nikah',
            'event_date' => $weddingDate,
            'event_time_start' => '08:00',
            'event_time_end' => '10:00',
            'venue_name' => 'Masjid Al-' . $faker->city,
            'venue_address' => $faker->address,
            'venue_map_url' => 'https://goo.gl/maps/example',
            'notes' => 'Tanpa mengurangi rasa hormat, acara akad nikah ini hanya dihadiri oleh keluarga inti.',
            'event_order' => 1,
        ]);

        // Resepsi
        $invitation->events()->create([
            'event_type' => 'resepsi',
            'event_name' => 'Resepsi Pernikahan',
            'event_date' => $weddingDate, // Usually same day
            'event_time_start' => '11:00',
            'event_time_end' => '13:00',
            'venue_name' => 'Gedung Serbaguna ' . $faker->company,
            'venue_address' => $faker->address,
            'venue_map_url' => 'https://goo.gl/maps/example',
            'notes' => 'Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu kepada kedua mempelai.',
            'event_order' => 2,
        ]);
    }

    private function createGuests(Invitation $invitation, $faker)
    {
        $guestCount = rand(5, 15);
        $groups = ['keluarga_pria', 'keluarga_wanita', 'teman', 'rekan_kerja', 'tetangga', 'lainnya'];

        for ($j = 0; $j < $guestCount; $j++) {
            $invitation->guests()->create([
                'name' => $faker->name,
                'phone' => '08' . $faker->numerify('##########'),
                'guest_code' => Str::upper(Str::random(8)),
                'guest_group' => $faker->randomElement($groups),
                'quota' => rand(1, 2),
            ]);
        }
    }
}
