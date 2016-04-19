<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('contact');
            $table->string('type');
            $table->string('other_type');
            $table->string('manufacturer');
            $table->string('other_manufacturer');
            $table->string('condition');
            $table->string('condition_details');
            $table->string('container');
            $table->boolean('shipping');
            $table->string('shipping_details');
            $table->boolean('meetups');
            $table->string('meetup_details');
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
        Schema::drop('market_items');
    }
}
