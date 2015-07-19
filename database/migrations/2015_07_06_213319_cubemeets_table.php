<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CubemeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cubemeets', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('host');
            $table->string('location');
            $table->string('description');
            $table->date('date');
            $table->time('start_time');
            $table->string('status');
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
        Schema::drop('cubemeets');
    }
}
