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
        Schema::table('users', function (Blueprint $table) {
            $table->string('other_university')->nullable()->after('university_id');
            $table->string('other_faculty')->nullable()->after('faculty_id');
            $table->string('other_career_path')->nullable()->after('career_path_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['other_university', 'other_faculty', 'other_career_path']);
        });
    }
};
