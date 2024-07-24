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
        Schema::create('escape_games_arrounds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_around');
            $table->bigInteger('id_escape_game');
            $table->foreign('id_around')->references('id')->on('arounds');
            $table->foreign('id_escape_game')->references('id')->on('escape_games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escape_game_arrounds');
    }
};
