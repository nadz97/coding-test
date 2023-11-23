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
            $table->uuid('id')->nullable(false)->primary();
            $table->string('order_id')->nullable(false);
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('status', ['SUCCESS', 'FAILED', 'PENDING'])->nullable();
            $table->text('description')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('token', 100)->nullable()->unique('transaction_token_Unique');
            $table->timestamps();
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
