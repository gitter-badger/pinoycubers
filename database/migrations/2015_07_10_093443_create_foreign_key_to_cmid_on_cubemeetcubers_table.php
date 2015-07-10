<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyToCmidOnCubemeetcubersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cubemeet_cubers', function (Blueprint $table) {
            $table->foreign('cm_id')
                  ->references('id')
                  ->on('cubemeets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cubemeet_cubers', function (Blueprint $table) {
            //
        });
    }
}
