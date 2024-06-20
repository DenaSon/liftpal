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
        Schema::create('couponable', function (Blueprint $table) {

            $table->foreignId('coupon_id')->constrained('coupons')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->morphs('couponable');

            $table->primary(['coupon_id','couponable_id','couponable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couponable');
    }
};
