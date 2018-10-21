<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('symbol')->unique();
            $table->string('direction')->comment('rtl , ltr');
            $table->integer('status')->comment('0 : LANGUAGE_INACTIVE , 1 : LANGUAGE_ACTIVE ');
            $table->integer('default')->comment('0 : NOT_DEFAULT , 1 : DEFAULT_LANGUAGE ');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger("language_id")->default(1)->after('is_vendor');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
