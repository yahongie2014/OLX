<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('image')->default("https://openclipart.org/image/2400px/svg_to_png/167281/generic-avatar.png");
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->float('longitude',13,2)->default(0);
            $table->float('latitudes',13,2)->default(0);
            $table->integer('activation_code')->default(0);
            $table->unsignedInteger('city_id');
            $table->integer('company_number')->default(0);
            $table->integer('is_verify')->default(0);
            $table->integer('is_blocked')->default(0);
            $table->integer('is_admin')->default(0);
            $table->integer('is_vendor')->default(0);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
