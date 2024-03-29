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

        Schema::create('build_steps', function (Blueprint $table) {
            $table->id();
            $table->string('task', 400);
            $table->longText('description')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('build_steps');
    }
};
