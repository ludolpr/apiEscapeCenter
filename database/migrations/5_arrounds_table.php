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
        Schema::create('arrounds', function (Blueprint $table) {
            $table->id();
            $table->string('name_around', 50);
            $table->text('description_around', 400);
            $table->string('picture_around', 255);
            $table->string('adress_around', 155);
            $table->string('town_around', 100);
            $table->string('zipcode_around', 5, 0);
            $table->string('lat_around', 50);
            $table->string('long_around', 50);
            $table->bigInteger('id_category');
            $table->foreign('id')->references('id_category')->on('categories_ar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrounds');
    }
};
