<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();

        $post = Post::create(array_merge(
            $request->except('price'),
            [
                'price' => $request->getPrice(),
                'user_id' => $request->user()->id
            ]
        ));

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post)
    {
        if (!$request->user()->can('update', $post)) {
            return abort(403, "You are not allowed to edit this post!");
        }

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validated();

        if (!$request->user()->can('update', $post)) {
            return abort(403, "You are not allowed to edit this post!");
        }

        $post->update(array_merge(
            $request->except('price'),
            [
                'price' => $request->getPrice() ?? $post->price
            ]
        ));

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        if (!$request->user()->can('delete', $post)) {
            return abort(403, "You are not allowed to delete this post!");
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
