<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('is_active')->default(1);
            $table->unsignedInteger('services_id');
            $table->unsignedInteger('subservices_id');
            $table->unsignedInteger('user_id');
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subservices_id')->references('id')->on('sub_services')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('rates', function (Blueprint $table) {
            $table->foreign('ads_id')->references('id')->on('advertisings')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisings');
    }
}
