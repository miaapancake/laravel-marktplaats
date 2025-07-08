@php($messageOwned = $message->author->id == Auth::user()->id)
<div
    @if($messageOwned)
        data-owned="true"
    @endif
    class="relative p-2 mb-10 rounded-md bg-neutral-200 data-[owned]:bg-blue-200 data-[owned]:left-full data-[owned]:-translate-x-full w-fit max-w-2/3"
>
    @if(!$messageOwned)
        <h1 class="font-semibold">{{$message->author->name}}</h1>
    @endif
    <p class="max-w-full whitespace-pre-wrap break-words">{{$message->content}}</p>
    <h2 class="absolute bottom-0 block whitespace-nowrap opacity-80 translate-y-full text-end @if($messageOwned) right-0 @else left-0 @endif">
        {{$message->created_at->format('F j, Y g:i a')}}
    </h2>
</div>
