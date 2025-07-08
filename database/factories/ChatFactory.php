<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeThisDecade,
            'updated_at' => null
        ];
    }



    /**

     * Configure the model factory.

     */

    public function configure(): static
    {
        return $this->afterCreating(function (Chat $chat) {
            $users = User::whereHas('posts')->get()->random(2);
            $chat->users()->sync($users);
            $chat->update([
                'post_id' => $this->faker->randomElement($users[0]->posts)->id
            ]);
        });
    }
}
