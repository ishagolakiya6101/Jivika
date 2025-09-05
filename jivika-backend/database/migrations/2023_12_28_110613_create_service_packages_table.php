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
        Schema::create('service_packages', function (Blueprint $table) {
            $table->id();
            $table->string('secure_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('included')->nullable();
            $table->text('excluded')->nullable();
            $table->text('how_work')->nullable();
            $table->double('price');
            $table->string('duration');
            $table->unsignedBigInteger('service_id');
            $table->string('image')->nullable();    
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_packages');
    }
};
