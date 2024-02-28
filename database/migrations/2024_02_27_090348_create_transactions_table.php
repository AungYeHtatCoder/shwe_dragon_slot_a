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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("external_transaction_id");
            $table->string("status");
            $table->string("game_status")->nullable()->default("ongoing");
            $table->unsignedBigInteger("operator_id")->default(0);
            $table->unsignedBigInteger("product_id")->default;
            $table->unsignedBigInteger("provider_id")->default(0);
            $table->unsignedBigInteger("provider_line_id")->default(0);
            $table->unsignedBigInteger("wager_id")->nullable();
            $table->unsignedBigInteger("currency_id")->default(22);
            $table->unsignedBigInteger("game_type")->default(1);
            $table->string("game_id")->default("TestGame");
            $table->string("game_round_id")->default("TestRoundID");
            $table->decimal("valid_bet_amount", 10, 2)->default(0.00);
            $table->decimal("bet_amount", 10, 2)->default(0.00);
            $table->decimal("transaction_amount", 10, 2)->default(0.00);
            $table->string("transaction_id")->default("221027032645244_3");
            $table->decimal("payout_amount", 10, 2)->default(0.00);
            $table->text("payout_detail")->nullable();
            $table->text("bet_detail")->nullable();
            $table->decimal("commision_amount", 10, 2)->default(0.00);
            $table->decimal("jackpot_amount", 10, 2)->default(0.00);
            $table->timestamp("settlement_date");
            $table->decimal("jp_bet", 10, 2)->default(0.00);
            $table->timestamp('created_on')->nullable();
            $table->timestamp('modified_on')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};