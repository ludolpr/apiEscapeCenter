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
        Schema::create('around_escape_game', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('around_id');
            $table->bigInteger('escape_game_id');
            $table->foreign('around_id')->references('id')->on('arounds');
            $table->foreign('escape_game_id')->references('id')->on('escape_games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('around_escape_game');
    }
};
