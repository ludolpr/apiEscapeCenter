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
        Schema::create('escape_games', function (Blueprint $table) {
            $table->id();
            $table->string('name_escape', 50);
            $table->text('description_escape', 400);
            $table->string('picture_escape', 255);
            $table->string('adress_escape', 155);
            $table->string('town_escape', 100);
            $table->string('zipcode_escape', 5, 0);
            $table->string('lat_escape', 50);
            $table->string('long_escape', 50);
            $table->bigInteger('id_category_eg');
            $table->foreign('id')->references('id_category_eg')->on('categories_eg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escape_game');
    }
};