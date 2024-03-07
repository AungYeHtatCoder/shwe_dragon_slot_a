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
        DB::statement(
            <<<SQL
            ALTER TABLE transactions
            ADD COLUMN event_id VARCHAR(191) GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.event_id'))) STORED,
            ADD COLUMN seamless_transaction_id VARCHAR(191) GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.seamless_transaction_id'))) STORED
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
