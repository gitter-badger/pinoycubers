<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Accounts\User::class, function ($faker) {
    return [
        'email' => $faker->email,
        'password' => Hash::make(str_random(10)),
        'first_name'  => $faker->firstName,
        'last_name' => $faker->lastName,
        'role_id' => App\Accounts\UserRole::$ADMIN
    ];
});

$factory->define(App\MarketItem::class, function ($faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'description' => $faker->text,
        'contact'  => $faker->randomFloat(0, 1000000, 100000000),
        'type' => 'other',
        'other_type' => $faker->word,
        'manufacturer' => 'other',
        'other_manufacturer' => $faker->word,
        'condition' => 'brandnew',
        'container' => 'boxed',
        'shipping' => 0,
        'meetups' => 1,
        'meetup_details' => $faker->text,
        'slug' => str_slug($title),
        'price' => $faker->numberBetween(350, 1500),
        'viewers' => serialize([])
    ];
});
