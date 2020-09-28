<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lmsclasses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('classhead_id');
            $table->string('teacher_name')->nullable();
            $table->string('name');
            $table->string('section');
            $table->text('description')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('lmsclasses');
    }
}
