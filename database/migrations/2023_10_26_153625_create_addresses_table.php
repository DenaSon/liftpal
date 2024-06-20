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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); // Foreign key to the users table
            $table->string('country',30)->nullable();
            $table->string('province',100)->nullable();
            $table->string('city',100);
            $table->mediumText('postal_address');
            $table->string('building_number',10)->nullable()->comment('پلاک ساختمان');
            $table->string('unit_number',10)->nullable()->comment('شماره واحد یا آپارتمان');
            $table->string('postal_code',15);
            $table->string('recipient_name',50)->nullable()->comment('نام گیرنده');
            $table->string('recipient_phone',20)->nullable()->comment('شماره گیرنده');
            $table->boolean('is_default')->default(false);

            $table->decimal('latitude', 10, 7)->nullable()->comment('The latitude coordinate of the address');
            $table->decimal('longitude', 10, 7)->nullable()->comment('The longitude coordinate of the address');

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
