<?php

use Faker\Generator as Faker;

$factory->define(App\Qcreative::class, function (Faker $faker) {
    return [
        //
        'question_id'=>1,
        'story'=>$faker->text,
        'question_1'=>$faker->name,
        'question_2'=>$faker->name,
        'question_3'=>$faker->name,
        'question_4'=>$faker->name,
        'q1_marks' =>1,
        'q2_marks'=>2,
        'q3_marks'=>3,
        'q4_marks'=>4,
        'all_marks'=>10,
    ];
});


