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
        Schema::create('sliders', function (Blueprint $table) {

        $table->id();
        $table->string('name',50)->comment('Name or title of the slider');
        $table->string('caption',250)->nullable()->comment('Description of the slider');
        $table->enum('status', ['active', 'inactive'])->default('active')->comment('Status of the slider (active, inactive)');
        $table->string('touch',10)->default('true')->comment('touch enable or disable');
        $table->string('cycle',10)->default('true')->comment('Autoplay option for the slider');
        $table->boolean('hover')->default(1);
        $table->string('autoplay',10)->default('carousel')->comment('Pause autoplay on slide hover');
        $table->integer('autoplay_interval')->default(1000);
        $table->boolean('indicators')->default(true);
        $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
