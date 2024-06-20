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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->nullable()->constrained('types')->cascadeOnDelete()->cascadeOnUpdate();

            // Product details

            $table->integer('quantity')->comment('The quantity of the product available in batch');

            $table->dateTime('entry_date')->nullable()->comment('The date when the product was entered into the stock');
            $table->dateTime('exit_date')->nullable()->comment('The date when the product was sold or removed');
            $table->dateTime('expire_date')->nullable()->comment('expire date of product');
            $table->unsignedInteger('expire_alert')->comment('alert timer before product expired : in Days');
            $table->unsignedInteger('reorder_level')->comment('alert timer before product quantity end  : in Days');
            $table->boolean('reorder_alert_send')->default(false)->comment('a flag that show reorder alert send or not');
            $table->boolean('expire_alert_send')->default(false)->comment('a flag that show expire alert send or not');
            $table->unsignedInteger('cost_price')->comment('The cost price of each unit');
            $table->unsignedInteger('sale_price')->comment('The sale price of each unit');
            $table->unsignedInteger('sales_number')->nullable()->comment('counter for sales');
            // Storage Fields
            $table->string('location_code', 20)->nullable()->comment('The location code where the stock is stored');
            $table->string('location', 100)->nullable()->comment('The location where the stock is stored');
            $table->string('section',70)->nullable()->comment('Section in the inventory where the product is stored');
            $table->string('shelf',70)->nullable()->comment('Shelf in the section where the product is stored');
            //Medical Fields


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
