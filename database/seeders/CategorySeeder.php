<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

const CATEGORIES = [
    "Cars" => [
        "Car Parts",
    ],
    "Electronics" => [
        "SmartPhones",
        "Video Game Consoles" => [
            "Nintendo" => [
                "Nintendo Entertainment System",
                "Super Nintendo Entertainment System",
                "Nintendo64",
                "Gameboy",
                "Gamecube",
                "Wii",
                "Nintendo DS",
                "Nintendo DSi",
                "Nintendo 3DS"
            ],
            "Playstation" => [
                "Playstation 1",
                "Playstation 2",
                "Playstation 3",
                "Playstation 4",
                "Playstation 5"
            ],
            "Xbox" => [
                "Xbox",
                "Xbox360",
                "Xbox One",
                "Xbox One S"
            ],
            "Valve" => [
                "SteamBox",
                "Valve Index"
            ]
        ],
        "Computers",
        "Computer Parts" => [
            "Monitors",
            "Video Cards",
            "CPUs",
            "Power Supplies"
        ],
    ],
    "Bikes" => [
        "BMX",
        "Mountain Bikes",
        "City Bikes",
        "E-Bikes",
        "Bike Parts"
    ],
];



function create_categories($parent, $categories)
{
    foreach ($categories as $k => $v) {
        $category = null;

        if (is_string($k)) {
            $category = Category::create([
                'name' => $k,
                'parent_id' => $parent
            ]);
        }

        if (is_string($v)) {
            $category = Category::create([
                'name' => $v,
                'parent_id' => $parent
            ]);
        } else if (is_array($v)) {
            create_categories($category->id, $v);
        }
    }
}

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        create_categories(null, CATEGORIES);
    }
}
