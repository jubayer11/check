<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acreatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_id');
            $table->integer('qcreative_id');
            $table->integer('user_id');
            $table->text('aquestion_1')->nullable();
            $table->integer('aq1_marks')->nullable();
            $table->text('aquestion_2')->nullable();
            $table->integer('aq2_marks')->nullable();
            $table->text('aquestion_3')->nullable();
            $table->integer('aq3_marks')->nullable();
            $table->text('aquestion_4')->nullable();
            $table->integer('aq4_marks')->nullable();
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
        Schema::dropIfExists('acreatives');
    }
}
