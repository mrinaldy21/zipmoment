<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoInvitationSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin', 'name' => 'Admin ZipMoment']);
        }

        $demos = [
            [
                'title' => 'The Wedding of Aditya & Sarah',
                'slug' => 'demo-minimalist',
                'template' => 'minimalist',
                'package_type' => 'basic',
                'groom_name' => 'Aditya Pratama, S.T.',
                'groom_description' => 'Putra bungsu dari Bapak H. Ahmad Pratama & Ibu Hj. Ratna Sari',
                'bride_name' => 'Sarah Clarissa, S.Ak.',
                'bride_description' => 'Putri pertama dari Bapak Dr. Gunawan Wibowo & Ibu Listya Indah',
                'event_date' => '2026-08-15 09:00:00',
                'event_location' => 'Gedung Sasana Kriya, TMII',
                'cover_photo' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=1200&q=80',
                'groom_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                'bride_photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Love in Bloom: Rafli & Nanda',
                'slug' => 'demo-romantic',
                'template' => 'romantic',
                'package_type' => 'premium',
                'groom_name' => 'Rafli Iskandar',
                'groom_description' => 'Sosok yang hangat dan penyayang, putra dari keluarga Iskandar yang terpandang di Yogyakarta.',
                'bride_name' => 'Nanda Putri',
                'bride_description' => 'Wanita yang penuh senyum dan kelembutan, lahir dan dibesarkan dalam tradisi keluarga yang harmonis.',
                'event_date' => '2026-06-21 10:00:00',
                'event_location' => 'Amanjiwo, Magelang',
                'cover_photo' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=80',
                'groom_photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80',
                'bride_photo' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&w=800&q=80',
                'groom_instagram' => '@rafli_isk',
                'bride_instagram' => '@nanda_p',
            ],
            [
                'title' => 'Eternity: Damian & Valery',
                'slug' => 'demo-cinematic',
                'template' => 'cinematic',
                'package_type' => 'exclusive',
                'groom_name' => 'Damian Wijaya',
                'groom_description' => 'Seorang visioner yang menemukan pelabuhan terakhirnya pada sosok Valery.',
                'bride_name' => 'Valery Anastasia',
                'bride_description' => 'Keanggunan yang terpancar nyata, menyempurnakan setiap langkah Damian.',
                'event_date' => '2026-12-12 18:00:00',
                'event_location' => 'Plataran Dharmawangsa, Jakarta',
                'cover_photo' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1200&q=80',
                'groom_photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=80',
                'bride_photo' => 'https://images.unsplash.com/photo-1509316785289-025f54246321?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Pernikahan Budi & Ani',
                'slug' => 'demo-elegant',
                'template' => 'elegant',
                'package_type' => 'basic',
                'groom_name' => 'Budi Setiawan',
                'groom_description' => 'Putra kesayangan Bapak Slamet & Ibu Sumiyati',
                'bride_name' => 'Ani Wijaya',
                'bride_description' => 'Putri tercinta Bapak Hartono & Ibu Retno',
                'event_date' => '2026-05-10 09:00:00',
                'event_location' => 'Balai Kartini, Jakarta',
                'cover_photo' => 'https://images.unsplash.com/photo-1544124499-58912cbddaad?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Modern Grace: Kevin & Clarissa',
                'slug' => 'demo-modern',
                'template' => 'modern',
                'package_type' => 'exclusive',
                'groom_name' => 'Kevin Sanjaya',
                'groom_description' => 'Dinamis, ambisius, dan penuh gaya.',
                'bride_name' => 'Clarissa Tanoe',
                'bride_description' => 'Modis, mandiri, dan inspiratif.',
                'event_date' => '2026-09-09 19:00:00',
                'event_location' => 'The Ritz-Carlton Jakarta',
                'cover_photo' => 'https://images.unsplash.com/photo-1549416878-b9ca35c2d47b?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'title' => 'Floral Symphony: Dimas & Dinda',
                'slug' => 'demo-floral',
                'template' => 'floral',
                'package_type' => 'premium',
                'groom_name' => 'Dimas Anggara',
                'groom_description' => 'Seorang pecinta seni dan alam.',
                'bride_name' => 'Dinda Kirana',
                'bride_description' => 'Lembut seindah bunga yang bermekaran.',
                'event_date' => '2026-07-07 08:00:00',
                'event_location' => 'Pine Forest Camp, Lembang',
                'cover_photo' => 'https://images.unsplash.com/photo-1522673607200-164883eeca48?auto=format&fit=crop&w=1200&q=80',
            ]
        ];

        foreach ($demos as $data) {
            $invitation = Invitation::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['user_id' => $admin->id])
            );

            // Add Events
            Event::updateOrCreate(
                ['invitation_id' => $invitation->id, 'event_type' => 'Akad Nikah'],
                [
                    'date' => $invitation->event_date,
                    'start_time' => '09:00',
                    'end_time' => '10:30',
                    'location' => $invitation->event_location,
                    'maps_link' => 'https://maps.google.com',
                ]
            );

            Event::updateOrCreate(
                ['invitation_id' => $invitation->id, 'event_type' => 'Resepsi'],
                [
                    'date' => $invitation->event_date,
                    'start_time' => '11:00',
                    'end_time' => '13:00',
                    'location' => $invitation->event_location,
                    'maps_link' => 'https://maps.google.com',
                ]
            );

            // Add Gallery
            for ($i = 0; $i < 4; $i++) {
                Gallery::create([
                    'invitation_id' => $invitation->id,
                    'photo_path' => "https://images.unsplash.com/photo-" . (1500000000000 + rand(0, 1000000000)) . "?auto=format&fit=crop&w=800&q=80",
                ]);
            }
        }
    }
}
