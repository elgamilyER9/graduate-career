<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'approved' and 'rejected' to the ENUM values to match the controller validation.
        if (Schema::hasTable('training_enrollments')) {
            \DB::statement("ALTER TABLE training_enrollments MODIFY status ENUM('pending','approved','rejected','enrolled','completed','dropped') NOT NULL DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('training_enrollments')) {
            \DB::statement("ALTER TABLE training_enrollments MODIFY status ENUM('pending','enrolled','completed','dropped') NOT NULL DEFAULT 'pending'");
        }
    }
};
