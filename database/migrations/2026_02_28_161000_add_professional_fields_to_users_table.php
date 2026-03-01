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
            $table->string('job_title')->nullable()->after('bio');
            $table->string('company')->nullable()->after('job_title');
            $table->integer('years_experience')->nullable()->after('company');
            $table->string('linkedin_url')->nullable()->after('years_experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['job_title', 'company', 'years_experience', 'linkedin_url']);
        });
    }
};
