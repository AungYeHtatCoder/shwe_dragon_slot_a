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
        Schema::create('place_bets', function (Blueprint $table) {
            $table->id();
            $table->string('MemberName')->nullable();
            $table->string('OperatorCode')->nullable();
            $table->unsignedBigInteger('ProductID')->default('0');
            $table->text('MessageID')->nullable();
            $table->string('RequestTime')->default('20240227032645');
            $table->text('Sign')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_bets');
    }
};