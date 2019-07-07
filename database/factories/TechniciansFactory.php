<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\Models\Technician::class, function (Faker $faker) {
    return [
        'first_name' => 'Maciej',
        'last_name' => 'Toborek',
        'email' => 'maciej.toborek@socialinterestgroup.org.uk',
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'phone' => '07305803712',
        'mobile' => '',
        'job_title' => 'Service Desk Analyst'
    ];
});
