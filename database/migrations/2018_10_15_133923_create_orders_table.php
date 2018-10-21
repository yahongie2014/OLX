<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status',array(1,2,3,4,5,6))->default(1)->comment('1 : ORDER_REQUEST , 2 : ORDER_PAID, 3 : ORDER_ACCEPTED, 4 : ORDER_PERPARED, 5 : ORDER_IN_DELIVERY, 6 : ORDER_DELVERID');
            $table->unsignedInteger('user_id');
            $table->string('order_number');
            $table->unsignedInteger('promo_code_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('total',13,2);
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
        Schema::dropIfExists('orders');
    }
}
