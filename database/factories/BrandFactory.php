<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->firstName(),
            "company" => $this->faker->company(),
            'brand_logo' => $this->faker->imageUrl($width=640, $height=480,  'cats', true, 'Faker', true),
            // "created_at" => $this->faker->dateTimeBetween($startDate= '-18 days', $endDate='now', $timezone= 'Asia/Yangon'),
            // "updated_at" => $this->faker->dateTimeBetween($startDate= '-18 days', $endDate='now', $timezone= 'Asia/Yangon'),
        ];
    }
}
