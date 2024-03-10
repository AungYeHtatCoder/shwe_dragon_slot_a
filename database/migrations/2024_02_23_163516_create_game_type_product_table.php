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
        Schema::create('game_type_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_type_id');
            $table->unsignedBigInteger('product_id');
            $table->string('image');
            $table->integer('rate');
            $table->timestamps();

            $table->foreign('game_type_id')->references('id')->on('game_types')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_type_product');
    }
};
