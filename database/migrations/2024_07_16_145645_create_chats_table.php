<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_position_id')->constrained('user_positions')->onDelete('cascade');
            $table->foreignId('authorized_user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->timestamp('time_of_message');
            $table->boolean('is_removed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
