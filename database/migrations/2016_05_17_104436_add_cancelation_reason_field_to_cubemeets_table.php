<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCancelationReasonFieldToCubemeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cubemeets', function(Blueprint $table) {
            $table->string('cancelation_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cubemeets', function(Blueprint $table) {
            $table->dropColumn('cancelation_reason');
        });
    }
}
