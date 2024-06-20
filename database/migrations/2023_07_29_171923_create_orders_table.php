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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // User information
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();


            $table->foreignId('address_id')
                ->constrained('addresses')
                ->cascadeOnDelete()->cascadeOnUpdate();


            // Order details
            $table->string('status', 60)
                ->index()
                ->comment('Order status (processed, shipped, delivered, etc.)');

            $table->decimal('total_price', 15, 2)
                ->comment('Total price of the order');

            $table->string('payment_status')
                ->comment('Payment status of the order-(paid, pending, canceled)');

            $table->string('payment_method')
                ->comment('Payment method (cash, credit card, bank transfer, etc.)');


            $table->text('shipping_address')
                ->nullable()
                ->comment('shipping address');

            $table->string('shipping_tracking',100)
                ->nullable()
                ->comment('shipping tracking number');

            $table->unsignedInteger('order_number')
                ->index()
                ->unique()
                ->comment('Unique order number');



            $table->string('shipping_method')
                ->comment('Shipping method (post, courier, etc.)');

            $table->decimal('shipping_cost', 10, 2)
                ->comment('Shipping cost for the order');

            $table->decimal('tax', 4, 2)
                ->comment('Tax amount for the order');

            $table->decimal('discount_amount', 10, 2)
                ->comment('Discount amount applied to the order');

            $table->decimal('subtotal', 15, 2)
                ->comment('Subtotal price of products');

            $table->decimal('grand_total', 15, 2)
                ->comment('Grand total including all costs');

            $table->string('currency')
                ->comment('Currency of the order');

            $table->date('payment_due_date')
                ->comment('Due date for payment of the order');

            $table->string('payment_transaction_id')
                ->nullable()
                ->comment('Payment transaction ID');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
