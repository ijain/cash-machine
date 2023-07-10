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
        Schema::create('transactions_sources', function (Blueprint $table) {
            $table->integer('transaction_id', false, true);
            $table->integer('source_id', false, true);
            $table->foreign('transaction_id')->references('id')->on('transactions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('source_id')->references('id')->on('transactions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_sources');
    }
};
