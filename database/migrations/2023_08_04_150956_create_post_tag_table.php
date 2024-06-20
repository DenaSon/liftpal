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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')
                ->references('id')->on('posts')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tag_id')
                ->references('id')->on('tags')
                ->cascadeOnUpdate()->cascadeOnDelete();

            // Add a unique constraint to prevent duplicate associations
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
