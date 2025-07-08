@extends('layouts.app')

@section('title', $post['title'])

@php($ownedByMe = Auth::user() && Auth::user()->id == $post->user_id)

@section('content')
    <div class="grid gap-4 items-start p-4 m-4 mx-auto max-w-5xl max-lg:grid-cols-1 grid-cols-[600px_auto]">
        <main class="card">
            <h2>@include('partials.categories.breadcrumb', ['category' => $post->category])</h2>
            <h1>
                <span class="text-2xl font-bold">{{$post->title}}</span>
            </h1>
            @if($ownedByMe)
                <div class="my-2">
                    <a class="inline-flex p-1 text-sm button" href="{{route('posts.edit', $post->id)}}">
                        <i class="size-4" data-lucide="pencil"></i>
                        <span>Edit</span>
                    </a>
                    <form
                        onsubmit="return confirm('Are you sure you want to delete this advertisement?');"
                        class="inline"
                        method="POST"
                        action="{{route('posts.destroy', $post->id)}}"
                    >
                        <button class="inline-flex p-1 text-sm button">
                            <i class="size-4" data-lucide="trash"></i>
                            <span>Delete</span>
                        </button>
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            @endif
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
                @if(!$ownedByMe)
                    <form action="{{route('chats.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}" />
                        <button class="mt-4 button">Send Message To Seller</button>
                    </form>
                @endif
            </div>
            <div class="mt-4 card">
                @if(!$ownedByMe)
                    @php($highestBid = $post->highestBid())
                    <form class="mb-4" action="{{route('bids.store')}}" method="POST">
                        <h1 class="font-semibold">Make a bid on this item</h1>
                        @include('partials.forminput', ['name' => 'amount', 'type' => 'price', 'value' => number_format(($highestBid ? $highestBid->amount/100 : 1)+1, 2) ])
                        <input name="post_id" type="hidden" value="{{$post->id}}" />
                        @csrf

                        <button class="mt-4 button">Submit</button>
                    </form>
                @endif
                <h1 class="font-semibold">Bids</h1>
                @php($bids = $post->bids()->orderBy('amount', 'desc')->get())

                @if(sizeof($bids) > 0)
                    @foreach($bids as $bid)
                        <div class="p-4 mt-2 rounded-md bg-neutral-200">
                            <h1 class="font-bold">{{$bid->displayPrice()}}</h1>
                            <h2>By {{$bid->user->name}}</h2>
                        </div>
                    @endforeach
                @else
                    <p>No bids yet...</p>
                @endif
            </div>
        </div>

    </div>
@endsection
