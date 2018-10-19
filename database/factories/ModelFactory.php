<?php
use App\Conpte;
use App\Operation;
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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
 $factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
}); 

$factory->define(App\Conpte::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'name'=>$faker->name
       
        
    ];
});


$factory->define(App\Operation::class, function (Faker\Generator $faker) {

    return [
        
        'date_operation' => $faker->dateTime(),
        'date_valeur' => $faker->dateTime(),
        'montant_net' => $faker->randomFloat(2, 1, 100 ),
        'vl_mad' => $faker->randomFloat(2, 1, 100 ),
        'opcvm' => $faker->word(6),
        'nombre_part' => $faker->numberBetween($min = 100, $max = 1000),
        'statut' => $faker->randomElement([Operation::valid_status,Operation::encours_status,Operation::annule_status]),
        'compte_id'=>1,
    ];
});