<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id');
            $table->integer('class_id');
            $table->string('type');
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->integer('exam_done')->nullable()->default(0);
            $table->integer('Active')->nullable()->default(1);
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
        Schema::dropIfExists('exams');
    }
}
