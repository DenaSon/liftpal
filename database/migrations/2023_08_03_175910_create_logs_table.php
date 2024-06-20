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
        Schema::create('logs', function (Blueprint $table) {

        $table->id();
        $table->foreignId('user_id')
            ->index()
            ->nullable()
            ->constrained('users')
            ->onDelete('set null');

        $table->string('action')
            ->comment('Description of the action');
        $table->text('description')
            ->nullable()
            ->comment('Additional details about the action (optional)');
        $table->timestamp('timestamp')
            ->useCurrent()
            ->comment('Date and time of the action (stored in UTC)');
        $table->string('ip_address', 45)
            ->nullable()
            ->comment('User\'s IP address (optional)');
        $table->text('user_agent')
            ->nullable()
            ->comment('User agent string (optional)');
        $table->string('severity', 20)
            ->comment('Severity level of the log entry');
        $table->string('source', 50)->default('')
            ->comment('Source or module of the log entry');
        $table->string('request_method', 10)
            ->nullable()
            ->comment('HTTP method used (optional)');
        $table->text('request_url')
            ->nullable()
            ->comment('URL or endpoint accessed (optional)');
        $table->text('request_payload')
            ->nullable()
            ->comment('Submitted data with the request (optional)');
        $table->integer('response_status')
            ->nullable()
            ->comment('HTTP status code of the response (optional)');
        $table->text('response_payload')
            ->nullable()
            ->comment('Data returned in the response (optional)');
        $table->text('error_message')
            ->nullable()
            ->comment('Error messages or stack traces (optional)');
        $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
