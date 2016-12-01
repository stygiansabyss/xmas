<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCharityFlagToAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->boolean('charity_flag')->default(0)->after('height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['charity_flag']);
        });
    }
}
