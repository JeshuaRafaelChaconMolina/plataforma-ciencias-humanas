<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Ciencias Sociales', 'type' => 'general'],
            ['name' => 'Educacion', 'type' => 'general'],
            ['name' => 'Psicologia', 'type' => 'general'],
            ['name' => 'Filosofia', 'type' => 'general'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
