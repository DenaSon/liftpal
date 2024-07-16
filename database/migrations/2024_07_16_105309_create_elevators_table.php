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
        Schema::create('elevators', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->string('model');
            $table->integer('capacity');
            $table->enum('type', ['passenger', 'freight', 'service', 'panoramic','other']);
            $table->string('manufacturer')->nullable();
            $table->date('last_inspection_date')->nullable();
            $table->date('installation_date');
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');

            $table->date('last_maintenance_date')->nullable();
            $table->date('next_maintenance_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elevators');
    }
};
