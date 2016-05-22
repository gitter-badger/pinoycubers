<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupMarketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('market_items', function(Blueprint $table) {
            $table->dropColumn('contact');
            $table->dropColumn('type');
            $table->dropColumn('other_type');
            $table->dropColumn('manufacturer');
            $table->dropColumn('other_manufacturer');
            $table->dropColumn('condition');
            $table->dropColumn('condition_details');
            $table->dropColumn('container');
            $table->renameColumn('shipping', 'shipping_available');
            $table->renameColumn('meetups', 'meetup_available');
            $table->dropColumn('viewers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('market_items', function(Blueprint $table) {
            $table->bigInteger('contact');
            $table->string('type');
            $table->string('other_type');
            $table->string('manufacturer');
            $table->string('other_manufacturer');
            $table->string('condition');
            $table->string('condition_details');
            $table->string('container');
            $table->renameColumn('shipping_available', 'shipping');
            $table->renameColumn('meetup_available', 'meetups');
            $table->text('viewers');
        });
    }
}
