<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('building_technician', function (Blueprint $table) {

            $table->dropColumn('id');


            $table->dropUnique(['building_id', 'user_id', 'company_id']);


            $table->primary(['building_id', 'user_id', 'company_id']);
        });
    }

    public function down(): void
    {
        Schema::table('building_technician', function (Blueprint $table) {



            $table->dropPrimary(['building_id', 'user_id', 'company_id']);


            $table->id()->first();


            $table->unique(['building_id', 'user_id', 'company_id']);
        });
    }



};
