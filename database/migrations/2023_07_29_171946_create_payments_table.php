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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained()
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('invoice_id')->constrained('invoices')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('wallet_id')->constrained('wallets')
            ->cascadeOnUpdate()->cascadeOnDelete();

            $table->decimal('amount', 10, 2);
            $table->string('payment_method',60);
            $table->string('transaction_id')->nullable();
            $table->string('status',20);
            $table->dateTime('payment_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('invoice_id');
            $table->index('status');
            $table->index('payment_date');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
