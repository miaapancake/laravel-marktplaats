@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <main class="p-0 my-4 mx-auto max-w-xl card">
        <h1 class="px-4 pt-4 mb-4 text-xl font-semibold">My Messages</h1>
        @if(sizeof($chats) > 0)
            @foreach($chats as $chat)
                @php($lastMessage = $chat->messages()->orderBy('created_at', 'desc')->first())
                <a href="{{route('chats.show', $chat->id)}}">
                    <div class="p-2 mt-2 border-t border-neutral-400">
                        <h1 class="text-lg font-bold">{{$chat->post->title}}</h1>
                        <h2>
                            chat with
                            @foreach($chat->users()->whereNot('user_id', Auth::user()->id)->get() as $user)
                                <span class="mr-2 font-semibold">{{$user->name}}</span>
                            @endforeach
                        </h2>
                        @if($lastMessage)
                            <h3>
                                <div class="font-semibold opacity-70">from {{$lastMessage->author->name}}</div>
                                <div>{{$lastMessage->content}}</div>
                            </h3>
                            <h4 class="mt-4 text-right">{{$lastMessage->created_at->format('F j, Y g:i a')}}</h4>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <p class="px-4 pb-2">No chats yet...</p>
        @endif
    </main>
@endsection
