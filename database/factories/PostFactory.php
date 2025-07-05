<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph(20),
            'user_id' => User::pluck('id')->random(),
            'premium' => $this->faker->boolean(5),
            'created_at' => $this->faker->dateTimeThisDecade(),
            'price' => $this->faker->numberBetween(0, 100_000),
            'category_id' => Category::pluck('id')->random(),
            'updated_at' => null
        ];
    }
}
