<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamLabsAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_labs_alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sound_href');
            $table->string('image_href');
            $table->integer('minimum_amount');
            $table->timeStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stream_labs_alerts');
    }
}
