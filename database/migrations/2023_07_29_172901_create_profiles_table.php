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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Create foreign key reference to users table
            $table->foreignId('user_id')->references('id')
            ->on('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name',150)->nullable();
            $table->string('last_name',150)->nullable();
            $table->string('education',100)->nullable();
            $table->string('phone')->nullable();
            $table->string('province',255)->nullable();
            $table->string('city',255)->nullable();
            $table->date('birth_year')->nullable();
            $table->string('address',255)->nullable();
            $table->text('resume')->nullable();
            $table->text('skills')->nullable();
            $table->string('avatar',255)->nullable();
            $table->timestamps();

            //indexes :
            $table->index('user_id');
            $table->index('education');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
