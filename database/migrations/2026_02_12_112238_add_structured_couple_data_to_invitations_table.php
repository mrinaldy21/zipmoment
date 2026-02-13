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
            // Groom
            $table->integer('groom_child_number')->nullable()->after('groom_description');
            $table->integer('groom_total_siblings')->nullable()->after('groom_child_number');
            $table->string('groom_father_name')->nullable()->after('groom_total_siblings');
            $table->string('groom_mother_name')->nullable()->after('groom_father_name');

            // Bride
            $table->integer('bride_child_number')->nullable()->after('bride_description');
            $table->integer('bride_total_siblings')->nullable()->after('bride_child_number');
            $table->string('bride_father_name')->nullable()->after('bride_total_siblings');
            $table->string('bride_mother_name')->nullable()->after('bride_father_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn([
                'groom_child_number', 'groom_total_siblings', 'groom_father_name', 'groom_mother_name',
                'bride_child_number', 'bride_total_siblings', 'bride_father_name', 'bride_mother_name'
            ]);
        });
    }
};
