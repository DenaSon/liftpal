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
            $table->string('name');
            $table->string('manager_name');
            $table->string('manager_national_code');
            $table->string('national_id')->nullable(); // شناسه ملی
            $table->string('economic_code')->nullable(); // کد اقتصادی
            $table->string('registration_code')->nullable(); // کد ثبت شرکت
            $table->string('address')->nullable(); // آدرس شرکت
            $table->string('phone');
            $table->string('email');
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
