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

        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400);
            $table->longText('description')->nullable();
            $table->string('hostname');
            $table->string('ip');
            $table->string('port');
            $table->string('url');
            $table->string('pass_phrase');
            $table->string('pass_file');
            $table->string('username');
            $table->string('status');
            $table->foreignId('environment_id')->constrained();
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
        Schema::dropIfExists('servers');
    }
};
