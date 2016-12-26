<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users')) {

        }
        Schema::create('users', function (Blueprint $table) {
            $table->increments('userID');
            $table->string('userName');
            $table->string('userEmail')->unique();
            $table->string('userPass');
            $table->enum('userStatus', ['Y', 'N'])->default('N');
            $table->string('tokenCode');
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
        Schema::drop('users');
    }
}
