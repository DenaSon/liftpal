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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('manager_national_code');
            $table->string('licence_code')->nullable();
            $table->string('economic_code')->nullable();
            $table->string('registration_code')->nullable();
            $table->string('province')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone')->nullable();
            $table->date('license_expiration_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
