<?php

namespace Database\Factories;

use App\Enum\ProductCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'quality' => $this->faker->randomDigit(),
            'sells_before' => $this->faker->randomDigit(),
            'category' => $this->faker->randomElement(ProductCategory::cases())->value,
        ];
    }
}
