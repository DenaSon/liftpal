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
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->references('id')
                ->on('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name',150)->nullable();
            $table->string('last_name',150)->nullable();
            $table->string('education',100)->nullable();
            $table->text('resume')->nullable();
            $table->timestamps();

            //indexes :
            $table->index('user_id');
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
