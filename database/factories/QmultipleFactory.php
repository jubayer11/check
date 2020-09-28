<?php

use Faker\Generator as Faker;

$factory->define(App\Qmultiple::class, function (Faker $faker) {
    return [
        //
        'question_id'=>2,
        'question'=>$faker->text,
        'option_1'=>$faker->name,
        'option_2'=>$faker->name,
        'option_3'=>$faker->name,
        'option_4'=>$faker->name,
        'marks'=>1,
    ];
});

