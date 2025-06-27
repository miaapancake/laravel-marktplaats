<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{

    private static $previousAmount = [];
    private static $previousDate = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::inRandomOrder()->first();

        // Generate a bid that is at minumum the highest bid (or 200 euros if no bid is there yet)
        // and at most the value of the item, with a precision of 5 cents
        BidFactory::$previousAmount[$post->id] = round($this->faker->numberBetween((BidFactory::$previousAmount[$post->id] ?? 200) + 5, $post->price) / 5) * 5;

        // Set the created_at to after the creation date of the highest bid or else that of the post
        BidFactory::$previousDate[$post->id] = $this->faker->dateTimeBetween(BidFactory::$previousDate[$post->id] ?? $post->created_at);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => $post->id,
            'amount' =>  BidFactory::$previousAmount[$post->id],
            'created_at' => BidFactory::$previousDate[$post->id],
            'updated_at' => null
        ];
    }
}
