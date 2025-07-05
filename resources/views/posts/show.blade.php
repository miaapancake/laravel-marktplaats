@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <div class="grid gap-4 items-start p-4 m-4 mx-auto max-w-5xl max-lg:grid-cols-1 grid-cols-[600px_auto]">
        <main class="card">
            <h2>@include('partials.categories.breadcrumb', ['category' => $post->category])</h2>
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
                <h1 class="font-semibold">Price</h1>
                <h2 class="text-xl font-bold">{{$post->displayPrice()}}</h2>
            </div>
            <div class="mt-4 card">
                @if(Auth::user() && Auth::user()->id != $post->user_id)
                    <form class="mb-4" action="{{route('bids.store')}}" method="POST">
                        <h1 class="font-semibold">Make a bid on this item</h1>
                        @include('partials.forminput', ['name' => 'amount', 'type' => 'price', 'value' => number_format(($post->highestBid()->amount/100)+1, 2) ])
                        <input name="post_id" type="hidden" value="{{$post->id}}" />
                        @csrf

                        <button class="mt-4 button">Submit</button>
                    </form>
                @endif
                <h1 class="font-semibold">Bids</h1>
                @foreach($post->bids()->orderBy('amount', 'desc')->get() as $bid)
                    <div class="p-4 mt-2 rounded-md bg-neutral-200">
                        <h1 class="font-bold">{{$bid->displayPrice()}}</h1>
                        <h2>By {{$bid->user->name}}</h2>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
