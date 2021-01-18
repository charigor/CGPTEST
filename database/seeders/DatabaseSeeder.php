<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        \App\Models\Company::factory(10001)->create()->each(function($company) {
            $clients = \App\Models\Client::factory()->create();
            $company->clients()->sync($clients);
        });

    }
}
