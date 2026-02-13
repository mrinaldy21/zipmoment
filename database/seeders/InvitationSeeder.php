<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Invitation;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invitation::create([
            'title' => 'Pernikahan Budi & Siti',
            'slug' => 'budi-siti',
            'groom_name' => 'Budi Santoso',
            'bride_name' => 'Siti Aminah',
            'event_date' => '2026-12-12 09:00:00',
            'event_location' => 'Gedung Serbaguna Jakarta',
            'map_link' => 'https://goo.gl/maps/example',
        ]);
    }
}
