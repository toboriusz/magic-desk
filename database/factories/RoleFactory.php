<?php

use Faker\Generator as Faker;
use App\Models\Role;

$factory->define(App\Models\Role::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => 'admin',
        'description' => 'Administrator privileges',
    ];
});
