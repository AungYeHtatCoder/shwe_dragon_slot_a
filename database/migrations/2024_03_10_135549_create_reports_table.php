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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('wager_id');
            $table->unsignedBigInteger('product_code');
            $table->unsignedBigInteger('game_type_id');
            $table->string('game_name');
            $table->string('game_round_id');
            $table->bigInteger('valid_bet_amount');
            $table->bigInteger('bet_amount');
            $table->bigInteger('payout_amount');
            $table->integer('commission_amount');
            $table->integer('jack_pot_amount');
            $table->integer('jp_bet');
            $table->integer('status');
            $table->datetime('created_on');
            $table->datetime('settlement_date');
            $table->datetime('modified_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
