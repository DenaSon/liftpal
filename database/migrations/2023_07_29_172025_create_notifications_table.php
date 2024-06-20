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
        Schema::create('notifications', function (Blueprint $table) {

            $table->id();
            $table->string('subject')->comment('Subject of the notification');
            $table->text('content')->comment('Content of the notification');
            $table->enum('channel',['phone','email','panel'])->comment('Send to users phone or email');
            $table->timestamp('scheduled_at')->nullable()->comment('Scheduled time for sending the notification');
            $table->timestamp('sent_at')->nullable()->comment('Time when the notification was actually sent');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
