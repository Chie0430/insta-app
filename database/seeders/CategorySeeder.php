<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Note: category name should be unique (no duplicates)
        $categories = [
            [
                'name' => 'Animals',
                'created_at' => now(),
                'updated_at' => now()
            ]
            [
                'name' => 'Sky Diving',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sports',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dancing',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        $this->category->insert($categories);
    }
}
