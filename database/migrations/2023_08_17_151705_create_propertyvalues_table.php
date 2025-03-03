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
        Schema::create('propertyvalues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->references('id')->on('properties')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('value')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propertyvalues');
    }
};
