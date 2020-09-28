<?php

use Faker\Generator as Faker;

$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        //
        'teacher_id'=>1,
        'class_id'=>1,
         'type' =>1,
         'status'=>1,
    ];
});
$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        //
        'teacher_id'=>1,
        'class_id'=>1,
        'type' =>2,
    ];
});
$factory->define(App\Exam::class, function (Faker $faker) {
    return [
        //
        'teacher_id'=>1,
        'class_id'=>1,
        'type' =>3,
    ];
});
