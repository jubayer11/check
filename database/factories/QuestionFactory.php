<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        //
        'exam_id'=>1,
        'type'=>'1',
    ];
});
$factory->define(App\Question::class, function (Faker $faker) {
    return [
        //
        'exam_id'=>1,
        'type'=>'2',
    ];
});
$factory->define(App\Question::class, function (Faker $faker) {
    return [
        //
        'exam_id'=>1,
        'type'=>'3',
    ];
});
