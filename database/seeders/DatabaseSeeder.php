<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountriesTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UserSeeder::class,
            ShopsTableSeeder::class,
            PartsTableSeeder::class,
            MiscellaneousCategoriesTableSeeder::class,
        ]);
    }
}
