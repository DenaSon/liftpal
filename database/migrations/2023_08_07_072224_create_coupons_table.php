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
        Schema::create('coupons', function (Blueprint $table) {

             $table->id(); // Adds an auto-incrementing ID column to the table
            $table->string('code')->unique()->index()->comment('Unique code for the coupon'); // Adds a unique, indexed string column for the coupon code
            $table->enum('type', ['percentage', 'fixed_amount'])->comment('Type of discount: percentage or fixed amount'); // Adds an enum column for the discount type
            $table->decimal('value', 10, 2)->comment('Value of the discount'); // Adds a decimal column for the discount value
            $table->date('start_date')->comment('Start date of the coupon validity'); // Adds a date column for the coupon start date
            $table->date('end_date')->comment('End date of the coupon validity'); // Adds a date column for the coupon end date
            $table->integer('max_uses')->nullable()->comment('Maximum number of times the coupon can be used'); // Adds an integer column for the maximum number of coupon uses (nullable)
            $table->decimal('minimum_purchase', 10, 2)->nullable()->comment('Minimum purchase amount to use the coupon'); // Adds a decimal column for the minimum purchase amount to use the coupon (nullable)
            $table->decimal('maximum_discount', 10, 2)->nullable()->comment('Maximum discount amount applicable with the coupon'); // Adds a decimal column for the maximum discount amount applicable with the coupon (nullable)
            $table->timestamps(); // Adds created_at and updated_at columns for tracking the record's creation and modification timestamps

            $table->index('start_date'); // Adds an index on the start_date column
            $table->index('end_date'); // Adds an index on the end_date column



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
