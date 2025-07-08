<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'alex',
            'email' => 'alex@mail.home.arpa',
        ]);

        User::factory(300)->create();

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            BidSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class
        ]);
    }
}
