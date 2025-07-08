<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::factory(Chat::count() * 30)->create();
    }
}
