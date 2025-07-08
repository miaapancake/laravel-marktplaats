<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chat = Chat::all()->random();

        return [
            'chat_id' => $chat->id,
            'author_id' =>  $this->faker->randomElement($chat->users)->id,
            'content' => $this->faker->paragraph(random_int(1, 5)),
            'created_at' => $this->faker->dateTimeBetween($chat->created_at)
        ];
    }
}
