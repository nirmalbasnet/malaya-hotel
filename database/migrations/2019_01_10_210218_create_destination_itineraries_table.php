<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('destination_id');
            $table->string('itinerary', 1000);
            $table->integer('day');
            $table->unsignedInteger('created_by');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('destination_itineraries');
    }
}