<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('username',100);
            $table->string('email',100);
            $table->string('password',250);
            $table->enum('suspend',['no', 'yes'])->default('no');
            $table->enum('designation',['super', 'staff', 'supreme'])->default('super');
            $table->enum('has_roles',['no', 'yes'])->default('no');
            $table->string('remember_token',100)->nullable();
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
        Schema::dropIfExists('admins');
    }
}
