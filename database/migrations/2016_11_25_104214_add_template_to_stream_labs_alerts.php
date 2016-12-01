<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemplateToStreamLabsAlerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stream_labs_alerts', function (Blueprint $table) {
            $table->string('template')->after('image_href');
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
            $table->dropColumn(['template']);
        });
    }
}
