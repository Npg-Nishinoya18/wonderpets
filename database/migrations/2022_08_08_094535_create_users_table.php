<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('title');
            $table->text('addressline');
            $table->text('town');
            $table->text('phone');
            $table->text('role');
            $table->string('user_img')->default('user.jpg');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('type', 64);
            $table->string('pet_img')->default('pet.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('serviceinfos', function ($table) {
            $table->increments('id');
            $table->date('date_serviced');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('groomings', function ($table) {
            $table->increments('id');
            $table->text('description');
            $table->string('title', 64);
            $table->decimal('grooming_cost', 10, 2);
            $table->string('groomings_img')->default('groomings.jpg');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('checkups', function ($table) {
            $table->increments('id');
            $table->integer('serviceinfos_id')->unsigned();
            $table->foreign('serviceinfos_id')->references('id')->on('serviceinfos');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->text('diseases_injuries');
            $table->text('comment');
            $table->decimal('cost', 10, 2);
            $table->timestamps();
        });

    Schema::create('serviceinfos_groomings', function ($table) {
            $table->integer('serviceinfos_id')->unsigned();
            $table->foreign('serviceinfos_id')->references('id')->on('serviceinfos');
            $table->integer('groomings_id')->unsigned();
            $table->foreign('groomings_id')->references('id')->on('groomings');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('comments', function ($table) {
            $table->increments('id');
            $table->text('name');
            $table->text('email')->unique();
            $table->text('comment');
            $table->integer('groomings_id')->unsigned();
            $table->foreign('groomings_id')->references('id')->on('groomings');
            $table->timestamps();
        });

        Schema::create('pet_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('pet_id')->unsigned();
            $table->foreign('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
