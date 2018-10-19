<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Conpte;
use App\Operation;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,15)->create();

        factory(App\Conpte::class,15)->create();

        factory(App\Operation::class,15)->create();

    }
}
