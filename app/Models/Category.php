<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function allSubcategories(): Collection
    {
        $categories = collect([]);
        $categoryQueue = [$this];

        while (sizeof($categoryQueue) > 0) {
            $category = array_pop($categoryQueue);
            array_push($categoryQueue, ...$category->categories);
            $categories->push($category);
        }

        return $categories;
    }

    public static function topLevelCategories()
    {
        return Category::where('parent_id', null);
    }
}
