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
        Schema::create('interactive_hotspots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interactive_scene_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('icon_url')->nullable();
            $table->string('icon_public_id')->nullable();
            $table->decimal('x_percent', 5, 2);
            $table->decimal('y_percent', 5, 2);
            $table->decimal('width_percent', 5, 2)->nullable();
            $table->string('target_type'); // gallery, couple, rsvp, gift, date_venue, love_story, dresscode, custom
            $table->string('target_value')->nullable();
            $table->string('custom_title')->nullable();
            $table->text('custom_content')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactive_hotspots');
    }
};
