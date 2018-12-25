<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',array(1,2,3,4,5))->default(1)->comment('1 : PENDING_ORDER , 2 : ORDER_RECEIVED, 3 : ORDER_ACCEPTED, 4 : ORDER_RECEIVED, 5 : NEW_MESSAGE');
            $table->unsignedInteger('user_id');
            $table->longText('message');
            $table->integer('link');
            $table->integer('is_read')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists("notifications");
    }
}
