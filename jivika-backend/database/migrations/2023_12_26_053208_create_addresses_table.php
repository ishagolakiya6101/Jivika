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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('secure_id');
            $table->unsignedBigInteger('user_id');
            $table->string('flat_building_no');
            $table->string('street');
            $table->string('landmark')->nullable();
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('default_address')->default(0);
            $table->enum('address_type',['home','office','other'])->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
