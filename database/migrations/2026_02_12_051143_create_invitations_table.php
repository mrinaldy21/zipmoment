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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('groom_name');
            $table->string('bride_name');
            $table->dateTime('event_date');
            $table->string('event_location');
            $table->text('map_link')->nullable();
            $table->string('cover_photo')->nullable();
            $table->enum('template', ['elegant', 'floral', 'modern'])->default('elegant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
