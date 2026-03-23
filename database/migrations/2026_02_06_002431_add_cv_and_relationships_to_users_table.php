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
            $table->string('cv')->nullable()->after('role');
            $table->foreignId('university_id')->nullable()->after('role')->constrained()->nullOnDelete();
            $table->foreignId('faculty_id')->nullable()->after('university_id')->constrained()->nullOnDelete();
            $table->foreignId('career_path_id')->nullable()->after('faculty_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['faculty_id']);
            $table->dropForeign(['career_path_id']);
            $table->dropColumn(['cv', 'faculty_id', 'career_path_id']);
        });
    }
};
