<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQcreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qcreatives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->text('story')->nullable();
            $table->string('question_1')->nullable();
            $table->string('question_2')->nullable();
            $table->string('question_3')->nullable();
            $table->string('question_4')->nullable();
            $table->integer('q1_marks')->nullable();
            $table->integer('q2_marks')->nullable();
            $table->integer('q3_marks')->nullable();
            $table->integer('q4_marks')->nullable();
            $table->integer('all_marks')->nullable();
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
        Schema::dropIfExists('qcreatives');
    }
}
