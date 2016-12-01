<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChristmasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Twitter
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('twitter_id')->unsigned()->index();
            $table->string('text', 200);
            $table->string('name', 200);
            $table->boolean('shown_flag')->default(0);
            $table->dateTime('twitter_created_at');
            $table->timestamps();
        });
        // Settings
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('value')->nullable();
            $table->string('type');
            $table->timestamps();
        });
        // Donations
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hb_id');
            $table->integer('amount');
            $table->string('name', 200)->nullable();
            $table->string('email');
            $table->text('comment')->nullable();
            $table->boolean('read_flag')->default(0);
            $table->boolean('shown_flag')->default(0);
            $table->timestamp('hb_created_at')->default(null);
            $table->timestamps();
        });
        Schema::create('donation_goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('start_value');
            $table->integer('goal');
            $table->timestamp('reached_at')->nullable();
            $table->timestamps();
        });
        Schema::create('donation_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('raised');
            $table->string('reason');
            $table->timestamps();
        });
        Schema::create('donation_incentives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('target');
            $table->integer('count')->unsigned()->default(0);
            $table->string('reward', 255);
            $table->timestamp('reached_at')->nullable();
            $table->timestamps();
        });
        // Raffles
        Schema::create('raffles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });
        Schema::create('raffle_tiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('raffle_id')->unsigned()->index();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->integer('minimum')->unsigned();
            $table->string('reward');
            $table->tinyInteger('level')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::create('raffle_winners', function (Blueprint $table) {
            $table->integer('raffle_tier_id')->unsigned()->index();
            $table->integer('donation_id')->unsigned()->index();
            $table->tinyInteger('status')->default(0);
        });
        Schema::create('raffle_donations', function (Blueprint $table) {
            $table->integer('raffle_tier_id')->unsigned()->index();
            $table->integer('donation_id')->unsigned()->index();
        });
        // Votes
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->boolean('accepting_flag')->index()->default(1);
            $table->tinyInteger('status')->default(1);
            $table->integer('percent')->unsigned()->default(0);
            $table->timestamps();
        });
        Schema::create('vote_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_id')->unsigned()->index();
            $table->string('key_word')->nullable();
            $table->integer('votes')->nullable()->default(0);
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
        Schema::drop('tweets');
        Schema::drop('settings');
        Schema::drop('donations');
        Schema::drop('donation_goals');
        Schema::drop('donation_totals');
        Schema::drop('donation_incentives');
        Schema::drop('raffles');
        Schema::drop('raffle_donations');
        Schema::drop('raffle_tiers');
        Schema::drop('raffle_winners');
        Schema::drop('votes');
        Schema::drop('vote_options');
    }
}
