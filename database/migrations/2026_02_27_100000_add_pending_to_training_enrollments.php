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
        // modifying enum values is not directly supported via fluent API, use raw SQL
        if (Schema::hasTable('training_enrollments')) {
            \DB::statement("ALTER TABLE training_enrollments MODIFY status ENUM('pending','enrolled','completed','dropped') NOT NULL DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('training_enrollments')) {
            \DB::statement("ALTER TABLE training_enrollments MODIFY status ENUM('enrolled','completed','dropped') NOT NULL DEFAULT 'enrolled'");
        }
    }
};