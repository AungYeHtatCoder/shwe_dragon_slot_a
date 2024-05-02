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
        Schema::table('wagers', function (Blueprint $table) {
            $table->foreignId("product_id");
            $table->foreignId("game_type_id");
            $table->decimal("bet_amount", 12);
            $table->decimal("payout_amount", 12)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wagers', function (Blueprint $table) {
            //
        });
    }
};
