<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create([
            'title' => 'Electronic',
        ]);
        Category::factory()->create([
            'title' => 'Auto',
        ]);
        Category::factory()->create([
            'title' => 'Science',
        ]);
    }
}
