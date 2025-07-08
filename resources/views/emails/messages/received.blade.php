<div>
    <h2>You've received <a href="{{route('chats.show', $chatMessage->chat_id)}}">a new message</a> from {{$chatMessage->author->name}}</h2>
    <p>{{$chatMessage->content}}</p>
</div>
