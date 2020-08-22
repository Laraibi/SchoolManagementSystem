<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\StudentParent;
use App\teacher;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
    
});



$factory->define(StudentParent::class, function (Faker $faker) {
    return [
        'FirstName' => $faker->firstName,
        'SecondName' => $faker->lastName 
    ];
});


$factory->define(teacher::class, function (Faker $faker) {
    return [
        'FirstName' => $faker->firstName,
        'SecondName' => $faker->lastName,
        'DateOfBirth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'Male'=>$faker->numberBetween(1,2),
        'Matiere_id'=>$faker->numberBetween(1,4),
    ];
});