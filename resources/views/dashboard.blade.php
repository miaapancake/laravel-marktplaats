@extends('layouts.app')

@section('title', "Dashboard")

@section('content')

<main class="grid grid-cols-2 m-auto mt-4 max-w-4xl">
    <div class="card">
        <h1 class="text-2xl font-bold">My Advertisements</h1>
        <a class="my-4 w-full button" href="{{route('posts.create')}}">
            <span>Create New Advertisement</span>
        </a>
        @foreach($postsPaginator as $post)
            <a href="{{route('posts.show', $post->id)}}">
                <div class="p-2 my-2 rounded-md hover:text-black bg-neutral-200 text-neutral-700 hover:bg-neutral-300">
                    <h1 class="font-semibold">{{$post->title}}</h1>
                    <h2>{{Str::limit($post->description, 50, '...')}}</h2>
                    <span>{{$post->displayPrice()}}</span>
                    <h2>Offered at {{$post->created_at->format("d-m-Y H:i")}}</h2>
                </div>
            </a>
        @endforeach

        {{$postsPaginator->links('partials.pagination')}}
    </div>
</main>

@endsection

