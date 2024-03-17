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
            ADD COLUMN name VARCHAR(100) GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.name'))) STORED,
            ADD COLUMN target_user_id bigint GENERATED ALWAYS AS ( json_unquote(json_extract(meta, '$.target_user_id'))) STORED
            SQL
        );

        Schema::table('transactions', function (Blueprint $table) {
            $table->index("target_user_id");
        });
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
