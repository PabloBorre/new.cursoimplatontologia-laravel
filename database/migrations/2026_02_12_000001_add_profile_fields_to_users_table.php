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
            // Role
            $table->string('role', 20)->default('student')->after('name');

            // Personal data
            $table->string('last_name')->after('role');
            $table->string('phone', 30)->nullable()->after('email');
            $table->text('previous_experience')->nullable()->after('phone');

            // File uploads (store file paths)
            $table->string('documentation')->nullable()->after('previous_experience');
            $table->string('diploma')->nullable()->after('documentation');
            $table->string('dental_license')->nullable()->after('diploma');

            // Optional fields
            $table->string('dental_clinic_name')->nullable()->after('dental_license');
            $table->string('position')->nullable()->after('dental_clinic_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'last_name',
                'phone',
                'previous_experience',
                'documentation',
                'diploma',
                'dental_license',
                'dental_clinic_name',
                'position',
            ]);
        });
    }
};
