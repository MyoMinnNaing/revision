<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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

        $actualPrice = rand(1, 5) * 20;
        $salePrice = $actualPrice + 15;

        return [
            "name" => $this->faker->name,
            "actual_price" => $actualPrice,
            "sale_price" => $salePrice,
            "brand_id" =>  rand(1,10),
            "unit" => $this->faker->randomElement(['single', 'dozen']),
        ];

    }
}
