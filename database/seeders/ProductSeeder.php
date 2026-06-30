<?php

namespace Database\Seeders;

use App\Enum\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ProductCategory::cases() as $category) {
            Product::factory(20)->create([
                'category' => $category,
            ]);
        }
    }
}
