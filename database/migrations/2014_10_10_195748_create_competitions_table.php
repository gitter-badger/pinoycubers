<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Let's use a flat table for now
        Schema::create('competitions', function($table)
        {
            $table->increments('id');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('name');
            $table->text('venue');
            $table->string('venue_website');
            $table->string('organizer');
            $table->string('organizer_email');
            $table->string('registration_fee');
            $table->text('registration_fee_notes');
            $table->text('competition_notes');
            $table->string('wca_delegate');
            $table->text('events');
            $table->text('registration_form_link');
            $table->text('register_competitions_link');
            $table->string('wca_competition_id');
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
        Schema::drop('competitions');
	}

}
