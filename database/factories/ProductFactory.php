<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'on-hold', 'expired']),
            'image_url' => $this->faker->imageUrl(),
            'monthly_inventory' => $this->faker->randomNumber(2),
        ];
    }
}
