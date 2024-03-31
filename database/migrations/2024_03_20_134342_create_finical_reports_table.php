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
        Schema::create('finical_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('date');
            $table->integer('turnover');
            $table->integer('payout');
            $table->integer('win_lose');
            $table->integer('commission');
            $table->integer('parent_commission');
        });

        Schema::table('finical_reports', function (Blueprint $table) {
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finical_reports');
    }
};
