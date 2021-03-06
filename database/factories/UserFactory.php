<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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
        'phone' => $faker->phoneNumber,
        'profile_image' => 'http://via.placeholder.com/150x150',
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Message::class, function (Faker $faker) {
//    genreate random numbers from 1 to 15, while the users dont send messages to them selves
    do{
        $from = rand(1 , 15);
        $to = rand(1 , 15);
        // if below condition is met we will continue to perform the above
    } while($from == $to);
    
    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence,

    ];
});
