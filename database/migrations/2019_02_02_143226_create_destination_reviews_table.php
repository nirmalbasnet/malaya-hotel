<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
//            $table->unsignedInteger('created_by');
            $table->unsignedInteger('destination_id');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->enum('reviewed', ['no', 'yes'])->default('no');
            $table->text('review');
            $table->integer('star_count');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
//            $table->foreign('created_by')->references('id')->on('admins')->onDelete('restrict');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
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
        Schema::dropIfExists('destination_reviews');
    }
}
