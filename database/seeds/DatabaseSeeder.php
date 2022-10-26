<?php

// use Database\Seeders\CouriersTableSeeder;
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
        // $this->call(IndoRegionSeeder::class);
        $this->call(CouriersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);

    }
}
