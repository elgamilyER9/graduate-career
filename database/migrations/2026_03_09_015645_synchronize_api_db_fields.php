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
        Schema::table('job_listings', function (Blueprint $table) {
            if (!Schema::hasColumn('job_listings', 'description'))
                $table->text('description')->nullable();
            if (!Schema::hasColumn('job_listings', 'location'))
                $table->string('location')->nullable();
            if (!Schema::hasColumn('job_listings', 'salary_range'))
                $table->string('salary_range')->nullable();
            if (!Schema::hasColumn('job_listings', 'type'))
                $table->string('type')->nullable();

            // Make career_path_id nullable to match controller validation
            $table->foreignId('career_path_id')->nullable()->change();
        });

        Schema::table('trainings', function (Blueprint $table) {
            if (!Schema::hasColumn('trainings', 'instructor'))
                $table->string('instructor')->nullable();
            if (!Schema::hasColumn('trainings', 'duration'))
                $table->string('duration')->nullable();
            if (!Schema::hasColumn('trainings', 'price'))
                $table->decimal('price', 10, 2)->nullable();
        });

        Schema::table('universities', function (Blueprint $table) {
            if (!Schema::hasColumn('universities', 'location'))
                $table->string('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            if (Schema::hasColumn('job_listings', 'description'))
                $table->dropColumn('description');
            if (Schema::hasColumn('job_listings', 'location'))
                $table->dropColumn('location');
            if (Schema::hasColumn('job_listings', 'salary_range'))
                $table->dropColumn('salary_range');
            if (Schema::hasColumn('job_listings', 'type'))
                $table->dropColumn('type');
        });

        Schema::table('trainings', function (Blueprint $table) {
            if (Schema::hasColumn('trainings', 'instructor'))
                $table->dropColumn('instructor');
            if (Schema::hasColumn('trainings', 'duration'))
                $table->dropColumn('duration');
            if (Schema::hasColumn('trainings', 'price'))
                $table->dropColumn('price');
        });

        Schema::table('universities', function (Blueprint $table) {
            if (Schema::hasColumn('universities', 'location'))
                $table->dropColumn('location');
        });
    }
};
