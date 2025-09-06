<?php

namespace Database\Seeders;

class CategorySeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedFromJson('categories.json', 'categories');
    }
}
