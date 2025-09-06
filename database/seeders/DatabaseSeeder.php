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
            ProvinceSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            AttractionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
