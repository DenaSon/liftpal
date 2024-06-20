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
            Schema::create('messages', function (Blueprint $table) {

       $table->id(); // Adds an auto-incrementing ID column to the table

    $table->foreignId('sender_id')
        ->constrained('users')
        ->references('id')
        ->cascadeOnUpdate()
        ->cascadeOnUpdate(); // Adds a foreign key column for the sender's ID, referencing the 'id' column in the 'users' table

    $table->foreignId('receiver_id')
        ->constrained('users')
        ->references('id')
        ->cascadeOnUpdate()
        ->cascadeOnUpdate(); // Adds a foreign key column for the receiver's ID, referencing the 'id' column in the 'users' table
    
    $table->string('title')
        ->index()
        ->nullable(); // Adds a string column for the message title, with an index and nullable constraint

    $table->text('content')
        ->nullable(); // Adds a text column for the message content, with a nullable constraint

    $table->boolean('is_read')
        ->index()
        ->default(false); // Adds a boolean column for tracking if the message has been read, with an index and a default value of false

    $table->timestamps(); // Adds created_at and updated_at columns for tracking the record's creation and modification timestamps




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
