<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            // GROOM & BRIDE MEDIA
            $table->string('groom_photo')->nullable();
            $table->string('bride_photo')->nullable();
            $table->string('groom_instagram')->nullable();
            $table->string('bride_instagram')->nullable();

            // EVENT DETAILS
            $table->dateTime('akad_date')->nullable();
            $table->string('akad_start')->nullable();
            $table->string('akad_end')->nullable();
            $table->string('akad_location')->nullable();
            $table->string('akad_maps')->nullable();

            $table->dateTime('resepsi_date')->nullable();
            $table->string('resepsi_start')->nullable();
            $table->string('resepsi_end')->nullable();
            $table->string('resepsi_location')->nullable();
            $table->string('resepsi_maps')->nullable();

            // LOVE STORY
            $table->text('story_intro')->nullable();
            $table->text('story_engagement')->nullable();
            $table->text('story_marriage')->nullable();
            $table->string('story_photo_intro')->nullable();
            $table->string('story_photo_engagement')->nullable();
            $table->string('story_photo_marriage')->nullable();

            // GIFT SECTION
            $table->string('gift_bank_pria')->nullable();
            $table->string('gift_bank_pria_name')->nullable();
            $table->string('gift_bank_wanita')->nullable();
            $table->string('gift_bank_wanita_name')->nullable();

            // MUSIC
            $table->string('music_path')->nullable();
            $table->string('music_title')->nullable();

            // FOOTER
            $table->string('contact_phone')->nullable();
            $table->string('contact_instagram')->nullable();
            $table->string('footer_website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn([
                'groom_photo', 'bride_photo', 'groom_instagram', 'bride_instagram',
                'akad_date', 'akad_start', 'akad_end', 'akad_location', 'akad_maps',
                'resepsi_date', 'resepsi_start', 'resepsi_end', 'resepsi_location', 'resepsi_maps',
                'story_intro', 'story_engagement', 'story_marriage',
                'story_photo_intro', 'story_photo_engagement', 'story_photo_marriage',
                'gift_bank_pria', 'gift_bank_pria_name', 'gift_bank_wanita', 'gift_bank_wanita_name',
                'music_path', 'music_title',
                'contact_phone', 'contact_instagram', 'footer_website'
            ]);
        });
    }
};
