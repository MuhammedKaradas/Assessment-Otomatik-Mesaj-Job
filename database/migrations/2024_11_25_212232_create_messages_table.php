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
            $table->id();
            $table->integer('unique_message_id')->nullable();
            $table->integer('contact_id');
            $table->integer('template_id');
            $table->integer(column: 'status');
            $table->timestamp('queue_send_date')->nullable();//kuyruğa alınma tarihi
            $table->timestamp('sent_date')->nullable();//gönderim tarihi
            $table->timestamps();
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
