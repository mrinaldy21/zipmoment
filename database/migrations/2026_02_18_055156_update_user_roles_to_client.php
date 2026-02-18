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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('client')->change();
        });

        // Update existing 'customer' to 'client'
        DB::table('users')->where('role', 'customer')->update(['role' => 'client']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->change();
        });

        DB::table('users')->where('role', 'client')->update(['role' => 'customer']);
    }
};
