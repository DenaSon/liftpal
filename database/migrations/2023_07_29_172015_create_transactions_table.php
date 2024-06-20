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
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();

            $table->bigInteger('amount'); // Amount of the transaction (payment made)
            $table->string('payment_method',40);
            $table->string('transaction_id')->nullable()->comment('Unique identifier (provided by pay gateway)');
            $table->string('status',30) ->default('pending')->comment('// Status of the invoice (paid, pending, canceled)');
            $table->string('card_hash',255)->nullable();
            $table->string('card_pen',255)->nullable();
            $table->string('reference_id',190)->nullable();
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
