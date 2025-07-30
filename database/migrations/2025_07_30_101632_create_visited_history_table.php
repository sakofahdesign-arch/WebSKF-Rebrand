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
        Schema::create('visited_history', function (Blueprint $table) {
    $table->id();
    $table->timestamp('login_time')->nullable();
    $table->string('ip_address')->nullable();
    $table->string('browser')->nullable();
    $table->string('version')->nullable();
    $table->string('platform')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visited_history');
    }
};
