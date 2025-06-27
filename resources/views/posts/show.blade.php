@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="grid gap-4 items-start p-4 m-4 mx-auto max-w-5xl max-lg:grid-cols-1 grid-cols-[600px_auto]">
        <main class="card">
            <h1 class="flex justify-between">
                <span class="text-2xl font-bold">{{$post->title}}</span>
                @if(Auth::user() && $post->user->id == Auth::user()->id)
                    <span>
                        <a class="inline-flex p-2 button" href="{{route('posts.edit', $post->id)}}">
                            <i class="size-4" data-lucide="pencil"></i>
                            <span>Edit</span>
                        </a>
                        <form
                            onsubmit="return confirm('Are you sure you want to delete this advertisement?');"
                            class="inline"
                            method="POST"
                            action="{{route('posts.destroy', $post->id)}}"
                        >
                            <button class="inline-flex p-2 button">
                                <i class="size-4" data-lucide="trash"></i>
                                <span>Delete</span>
                            </button>
                            @method('DELETE')
                            @csrf
                        </form>
                    </span>
                @endif
            </h1>
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
        <div>
            <div class="card">
                <h1 class="text-xl font-semibold">Price</h1>
                <h2 class="text-xl font-bold">{{$post->displayPrice()}}</h2>
            </div>
        </div>

    </div>
@endsection
