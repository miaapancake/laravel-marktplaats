@extends('layouts.app')

@section('title', "Create a new advertisement")

@section('content')
    <main class="m-4 mx-auto max-w-xl card">
        <h1 class="text-xl font-bold">Edit advertisement</h1>
        <form method="POST" action="{{route('posts.update', $post->id)}}">
            @include('partials.forminput', ['name' => 'title', 'value' => $post->title])
            @include('partials.forminput', ['name' => 'description', 'type' => 'textarea', 'value' => $post->description])
            @include('partials.forminput', ['name' => 'price', 'type' => 'number', 'value' => $post->price / 100])

            @include('partials.forminput', ['name' => 'category', 'type' => 'select', 'items' => $categories, 'selected' => $post->category_id])

            @method('PUT')
            @csrf

            <div class="flex justify-end mt-4">
                <button class="button">Update Advertisement</button>
            </div>
        </form>
    </main>
@endsection
