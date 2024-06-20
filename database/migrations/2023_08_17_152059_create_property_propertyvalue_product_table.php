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
        Schema::create('property_propertyvalue_product', function (Blueprint $table) {
            $table->foreignId('propertyvalue_id')->references('id')->on('propertyvalues')
            ->cascadeOnUpdate()->cascadeOnUpdate();

            $table->foreignId('product_id')->references('id')->on('products')
                ->cascadeOnUpdate()->cascadeOnUpdate();

            $table->primary(['product_id','propertyvalue_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_propertyvalue_product');
    }
};
