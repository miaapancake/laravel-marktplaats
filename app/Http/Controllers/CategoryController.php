<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $postPaginator = Post::orderBy('premium', 'desc')->orderBy('created_at', 'desc')->whereIn('category_id', $category->allSubcategories()->pluck('id'))->paginate(50)->onEachSide(1);

        return view('posts.index', compact('postPaginator', 'category'));
    }
}
