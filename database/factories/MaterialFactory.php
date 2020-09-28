<?php

use Faker\Generator as Faker;

$factory->define(App\Material::class, function (Faker $faker) {
    return [
        'lmsclass_id'=>1,
        'user_id'=>1,
        'title'=>$faker->title,
        'body'=>$faker->text,
        'option'=>'lesson',

    ];
});
