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
        Schema::create('wagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("wager_id")->index();
            $table->string("member_name");
            $table->unsignedBigInteger("product_id");
            $table->integer("game_type");
            $table->integer("currency_id");
            $table->string("game_id");
            $table->string("game_round_id");
            $table->decimal("valid_bet_amount", 10, 2)->default(0.00);
            $table->decimal("bet_amount", 10, 2)->default(0.00);
            $table->decimal("jp_bet", 10, 2)->default(0.00);
            $table->decimal("pay_out_amount", 10, 2)->default(0.00);
            $table->decimal("commision_amount", 10, 2)->default(0.00);
            $table->decimal("jackpot_amount", 10, 2)->default(0.00);
            $table->timestamp("settlement_date");
            $table->integer("status")->default(0);
            $table->timestamp('created_on')->nullable();
            $table->timestamp('modified_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wagers');
    }
};