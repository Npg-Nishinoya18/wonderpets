<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroomingimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groomingimages', function (Blueprint $table) {
            $table->id();
            $table->string('groomings_img')->default('groomings.jpg');
            $table->integer('groomings_id')->unsigned();
            $table->foreign('groomings_id')->references('id')->on('groomings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groomingimages');
    }
}
