<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamLabsTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_labs_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('twitch_id')->unsigned()->index();
            $table->string('channel')->index();
            $table->string('api_token')->nullable()->index();
            $table->string('access_token');
            $table->string('refresh_token');
            $table->dateTime('expires_at');
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
        Schema::drop('stream_labs_tokens');
    }
}
