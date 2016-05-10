<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameHostsToUserIdOnCubemeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cubemeets_cubers', function (Blueprint $table) {
            $table->renameColumn('host', 'user_id');
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
            $table->renameColumn('user_id', 'host');
        });
    }
}
