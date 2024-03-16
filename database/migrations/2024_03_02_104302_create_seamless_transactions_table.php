<?php

use App\Enums\TransactionStatus;
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
        Schema::create('seamless_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("seamless_event_id");
            $table->foreignId("user_id");
            $table->foreignId("product_id");
            $table->foreignId("game_type_id");
            $table->string("wager_id")->nullable();
            $table->string("seamless_transaction_id")->nullable();
            $table->decimal("rate");
            $table->decimal("transaction_amount", 12);
            $table->decimal("bet_amount", 12);
            $table->decimal("valid_amount", 12);
            $table->string("status")->default(TransactionStatus::Pending);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seamless_transactions');
    }
};
