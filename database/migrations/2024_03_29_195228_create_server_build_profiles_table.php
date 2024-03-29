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
        Schema::disableForeignKeyConstraints();

        Schema::create('server_build_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->foreignId('server_id')->constrained();
            $table->foreignId('build_profile_id')->constrained();
            $table->foreignId('owner_id')->constrained('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_build_profiles');
    }
};
