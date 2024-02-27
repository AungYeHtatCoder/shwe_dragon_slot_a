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
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('wallet', 10, 2)->default(0.00); 
            $table->unsignedBigInteger('MemberID')->nullable();
            $table->unsignedBigInteger('OperatorID')->nullable();
            $table->unsignedBigInteger('ProductID')->nullable();
            $table->unsignedBigInteger('ProviderID')->nullable();
            $table->unsignedBigInteger('ProviderLineID')->nullable();
            $table->unsignedBigInteger('WagerID')->nullable();
            $table->unsignedBigInteger('CurrencyID')->nullable();
            $table->unsignedBigInteger('GameType')->nullable(); 
            $table->unsignedBigInteger('GameID')->nullable();
            $table->unsignedBigInteger('GameRoundID')->nullable();
            $table->decimal('ValidBetAmount', 10, 2)->default(0.00);
            $table->decimal('BetAmount', 10, 2)->default(0.00);
            $table->decimal('TransactionAmount', 10, 2)->default(0.00);
            $table->unsignedBigInteger('TransactionID')->nullable(); 
            $table->decimal('PayoutAmount', 10, 2)->default(0.00);
            $table->text('PayoutDetail')->nullable();
            $table->text('BetDetail')->nullable();
            $table->decimal('CommisionAmount', 10, 2)->default(0.00);
            $table->decimal('JackpotAmount', 10, 2)->default(0.00);
            $table->timestamp('SettlementDate')->nullable();
            $table->decimal('JPBet', 10, 2)->default(0.00);
            $table->integer('Status')->default(0);
            $table->timestamp('CreatedOn')->nullable();
            $table->timestamp('ModifiedOn')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallets');
    }
};