<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('desc');
            $table->integer('is_delivery')->default(0);
            $table->unsignedInteger('advertising_id');
            $table->float('percentage',13,2);
            $table->enum('locale',array(["en","ar"]))->index();
            $table->foreign('advertising_id')->references('id')->on('advertisings')->onDelete('cascade');
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
        Schema::dropIfExists('advertising_translations');
    }
}
