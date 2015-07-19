<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionScheduleEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('competition_schedule_events', function($table)
        {
            $table->increments('id');
            $table->integer('competition_schedule_id');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('event_name');
            $table->string('round_label');
            $table->string('format_label');
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
		//
        Schema::drop('competition_schedule_events');
	}

}
