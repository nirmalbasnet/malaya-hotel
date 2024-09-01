<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 1000);
            $table->string('trip_destination', 1000);
            $table->string('total_duration', 1000);
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->string('primary_activities', 1000);
            $table->string('group_size', 1000);
            $table->string('transportation', 1000);
            $table->string('price');
            $table->text('summary');
            $table->enum('top', ['no', 'yes'])->default('no');
            $table->enum('publish', ['no', 'yes'])->default('no');
            $table->text('review');
            $table->string('slug', 1000);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('restrict');
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
        Schema::dropIfExists('destination');
    }
}
