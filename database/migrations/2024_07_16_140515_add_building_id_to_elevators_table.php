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
        Schema::table('elevators', function (Blueprint $table) {

            $table->foreignId('building_id')->after('user_id')->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elevators', function (Blueprint $table) {
            $table->dropForeign(['building_id']);
            $table->dropColumn('building_id');

        });
    }
};
