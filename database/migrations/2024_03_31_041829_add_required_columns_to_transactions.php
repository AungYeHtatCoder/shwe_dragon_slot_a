<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->boolean('is_report_generated')->default(false)->index();
        });

        DB::statement(
            <<<SQL
            ALTER TABLE transactions
            ADD COLUMN wager_id BIGINT GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.wager_id'))) STORED
            SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
