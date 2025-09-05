<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id'); // Who performs the action
            $table->unsignedBigInteger('to_id');   // Who receives the notification
            $table->string('title');
            $table->text('body');
            $table->string('entity_type');         // Notification entity type (e.g., Booking)
            $table->unsignedBigInteger('entity_id'); // Notification entity ID (e.g., Booking ID)
            $table->timestamps();

            $table->foreign('from_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
