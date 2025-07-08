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
        <div data-scroll-to-bottom class="overflow-scroll relative py-2 border-t max-h-[50vh] border-t-neutral-300">
            <div class="p-2 mb-4 text-sm font-bold text-center bg-green-200 rounded-md">Chat was created at {{$chat->created_at->format('F j, Y g:i a')}}!</div>
            <div id="messages">
                @foreach($chat->messages()->orderBy('created_at', 'asc')->get() as $message)
                    @include('chats.partials.message', ['message' => $message])
                @endforeach
            </div>
        </div>
        <form
            hx-post="{{route('messages.store')}}"
            method="post"
            hx-target="#messages"
            hx-swap="beforeend"
            hx-on::after-request="this.reset()"
        >
            <div class="relative mt-4 rounded-md border-1 border-neutral-400 outline-blue-400 focus-within:outline-2">
                <textarea
                    name="message"
                    id="message"
                    type="text"
                    placeholder="Type your message here..."
                    class="inline-block border-none focus:outline-none input"
                ></textarea>
                <input type="hidden" name="chat_id" value="{{$chat->id}}" />
                <span class="block pb-2 pl-2 opacity-50">Press Shift + Enter for a new line</span>
                <button title="Send Message" class="absolute right-2 bottom-2 p-1 border-none button">
                    <i class="size-6" data-lucide="send"></i>
                </button>
            </div>
        </form>
    </main>
@endsection
