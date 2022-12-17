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
            'name' =>  $this->faker->unique()->sentence(),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'description' => $this->faker->realText($maxNbChars = 50),
            'image_path'=> $this->faker->imageUrl($width = 640,$height = 480),
            'user_id'=> 1
        ];
    }
}
