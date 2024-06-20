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
        Schema::create('suppliers', function (Blueprint $table) {

            $table->id();
            $table->string('name', 100);
            $table->text('address')->nullable()->comment('Address of the supplier');
            $table->string('contact_name', 100)->nullable()->comment('Main contact person\'s name');
            $table->string('email', 255)->nullable()->comment('Email address of the main contact person');
            $table->unsignedInteger('rating')->nullable()->comment('Supplier\'s rating based on performance/feedback');
            $table->string('phone', 20)->nullable()->comment('Phone number of the main contact person');
            $table->string('website', 255)->nullable()->comment('Supplier\'s website (if available)');
            $table->text('description')->nullable()->comment('Brief description of the supplier');
            $table->string('license_number')->nullable()->comment('supplier license_number');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
