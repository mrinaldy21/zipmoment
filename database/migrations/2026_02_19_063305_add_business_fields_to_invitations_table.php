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
            $table->enum('package_type', ['basic', 'premium', 'exclusive'])->default('basic')->after('template');
            $table->boolean('is_watermark_enabled')->default(true)->after('package_type');
            $table->string('custom_domain')->nullable()->unique()->after('is_watermark_enabled');
            $table->integer('gallery_limit')->default(5)->after('custom_domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['package_type', 'is_watermark_enabled', 'custom_domain', 'gallery_limit']);
        });
    }
};
