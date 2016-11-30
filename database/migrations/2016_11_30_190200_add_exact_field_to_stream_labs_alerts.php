<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExactFieldToStreamLabsAlerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stream_labs_alerts', function (Blueprint $table) {
            $table->boolean('exact')->after('minimum_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stream_labs_alerts', function (Blueprint $table) {
            $table->dropColumn(['exact']);
        });
    }
}
