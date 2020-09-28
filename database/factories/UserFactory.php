<?php

use App\Announcement;
use App\Assaignment;
use App\Lmsclass;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

    ];
});
$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'lmsclass_id'=>1,
        'user_id'=>1,
        'body'=>$faker->text,

    ];
});
$factory->define(Assaignment::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'lmsclass_id'=>1,
        'user_id'=>1,
        'body'=>$faker->text,
         'deadline'=>$faker->date(),

    ];
});
$factory->define(Lmsclass::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'classhead_id'=>1,
        'user_id'=>1,
        'description'=>$faker->text,
        'section'=>$faker->randomDigitNotNull,
        'status'=>$faker->randomDigit,

    ];
});
