@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="grid gap-4 items-start p-4 m-4 mx-auto max-w-5xl max-lg:grid-cols-1 grid-cols-[600px_auto]">
        <main class="card">
            <h1 class="text-2xl font-bold">{{$post->title}}</h1>
            <h2 class="text-neutral-800">
                <span>
                    Offered by
                </span>
                <a
                    class="font-bold text-blue-500" href="{{route('users.show', $post->user->id)}}"
                >
                    {{$post->user->name}}
                </a>
                <span> at {{$post->created_at->format('F j, Y g:i a')}}</span>
            </h2>
            <p class="mt-4 whitespace-pre-line">{{$post->description}}</p>
        </main>
        <div class="card">
            <h1 class="text-xl font-bold">Price</h1>
            <h2 class="font-semibold">{{$post->displayPrice()}}</h2>
            <h1 class="text-xl font-bold">Bids</h1>
        </div>
    </div>
@endsection
