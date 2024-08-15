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
        Schema::create('building', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('manager_name');
            $table->string('manager_contact');
            $table->string('emergency_contact')->nullable();
            $table->string('builder_name',120)->nullable();
            $table->integer('floors');
            $table->integer('units');
            $table->text('address')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building');
    }
};
