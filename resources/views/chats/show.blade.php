@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <main class="my-4 mx-auto max-w-3xl card">
        <a class="hover:underline" href="{{route('posts.show', $chat->post->id)}}">
            <h1 class="mb-4 text-xl font-semibold">{{$chat->post->title}}</h1>
        </a>
        <h2 class="py-2 border-t border-t-neutral-300">
            @foreach($chat->users as $user)
                <span class="font-semibold">{{$user->name}}</span>
                @if(!$loop->last)
                    <span>•</span>
                @endif
            @endforeach
        </h2>
        <div data-scroll-to-bottom class="overflow-scroll relative py-2 border-t max-h-[60vh] border-t-neutral-300">
            <div class="p-2 mb-4 text-sm font-bold text-center bg-green-200 rounded-md">Chat was created at {{$chat->created_at->format('F j, Y g:i a')}}!</div>
            @foreach($chat->messages()->orderBy('created_at', 'asc')->get() as $message)
                @php($messageOwned = $message->author->id == Auth::user()->id)
                <div
                    @if($messageOwned)
                        data-owned="true"
                    @endif
                    class="relative p-2 mb-10 rounded-md bg-neutral-200 data-[owned]:bg-blue-200 data-[owned]:left-full data-[owned]:-translate-x-full max-w-2/3"
                >
                    @if(!$messageOwned)
                        <h1 class="font-semibold">{{$message->author->name}}</h1>
                    @endif
                    <p>{{$message->content}}</p>
                    <h2 class="absolute bottom-0 opacity-80 translate-y-full text-end @if($messageOwned) right-0 @else left-0 @endif">
                        {{$message->created_at->format('F j, Y g:i a')}}
                    </h2>
                </div>
            @endforeach
        </div>
        <form>
            <div class="flex items-center mt-4">
                <input type="text" placeholder="Type your message here..." class="inline-block w-full h-10 rounded-r-none border-r-0 input" />
                <button class="inline-flex p-0 rounded-l-none size-10 button">
                    <i class="size-4" data-lucide="send"></i>
                </button>
            </div>
        </form>
    </main>
@endsection
