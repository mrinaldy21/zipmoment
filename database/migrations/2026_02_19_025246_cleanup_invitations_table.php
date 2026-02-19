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
            $table->dropColumn([
                'story_intro',
                'story_photo_intro',
                'story_engagement',
                'story_photo_engagement',
                'story_marriage',
                'story_photo_marriage'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->text('story_intro')->nullable();
            $table->string('story_photo_intro')->nullable();
            $table->text('story_engagement')->nullable();
            $table->string('story_photo_engagement')->nullable();
            $table->text('story_marriage')->nullable();
            $table->string('story_photo_marriage')->nullable();
        });
    }
};
