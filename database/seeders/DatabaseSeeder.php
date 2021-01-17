<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $companies =  \App\Models\Company::factory(10000)->create();
        $clients = \App\Models\Client::factory(10000)->create();
        $companies->first()->clients()->sync($clients);
    }
}
