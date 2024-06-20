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
        Schema::create('wallets', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained('users')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('balance', 10, 2);
            $table->string('currency', 20)->default('IRT')
            ->comment('IRT =  Tomans and IRR = Rials');
            $table->boolean('is_active');
            $table->timestamp('last_transaction_at')->nullable();
            $table->timestamps();

            //indexes :
            $table->index('user_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
