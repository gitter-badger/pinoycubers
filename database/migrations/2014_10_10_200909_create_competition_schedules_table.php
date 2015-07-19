<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('competition_schedules', function($table)
        {
            $table->increments('id');
            $table->integer('competition_id');
            $table->date('schedule_date');
            $table->integer('schedule_order');
            $table->string('schedule_day_label');
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
        Schema::drop('competition_schedules');
	}

}
