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
        Schema::table('trainings', function (Blueprint $table) {
            // Add mentor_id if not exists
            if (!Schema::hasColumn('trainings', 'mentor_id')) {
                $table->foreignId('mentor_id')->nullable()->constrained('users')->cascadeOnDelete();
            }
            // Add description if not exists
            if (!Schema::hasColumn('trainings', 'description')) {
                $table->text('description')->nullable();
            }
            // Add name if not exists (alias for title)
            if (!Schema::hasColumn('trainings', 'name')) {
                $table->string('name')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            if (Schema::hasColumn('trainings', 'mentor_id')) {
                $table->dropForeignIdFor(\App\Models\User::class);
            }
            if (Schema::hasColumn('trainings', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('trainings', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
