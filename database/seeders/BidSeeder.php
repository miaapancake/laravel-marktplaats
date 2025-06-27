<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Post;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bid::factory(Post::count() * 5)->create();
    }
}
