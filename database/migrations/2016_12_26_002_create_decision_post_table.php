<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecisionPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('decision_post')) {
            Schema::create('decision_post', function (Blueprint $table) {
                $table->increments('id');
                $table->string('post_type');
                $table->string('post_fname');
                $table->string('post_email');
                $table->text('post_content');
                $table->string('post_imageO_name');
                $table->string('post_imageO_path');
                $table->string('post_imageO_type');
                $table->string('post_imageR_name');
                $table->string('post_imageR_path');
                $table->string('post_imageR_type');
                $table->string('post_imageL_name');
                $table->string('post_imageL_path');
                $table->string('post_imageL_type');
                $table->string('post_endpost');
                $table->string('post_answerL');
                $table->string('post_answerR');
                $table->integer('post_answer1')->unsigned();
                $table->integer('post_answer2')->unsigned();
                $table->integer('post_answer3')->unsigned();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('decision_post');
    }
}
