@extends('layouts.app')

@section('content')
<div class="grid p-4 m-auto my-4 max-w-7xl">
    <div>
        <main class="grid grid-cols-4 gap-4 max-sm:grid-cols-1 max-md:grid-cols-2 max-lg:grid-cols-3">
            @foreach($postPaginator as $post)
                <a href="{{route('posts.show', $post->id)}}">
                    <div class="flex flex-col justify-between h-full hover:shadow-lg card">
                        <h1 class="mb-4">{{$post->title}}</h1>
                        <h2 class="text-lg font-bold text-neutral-800">{{$post->displayPrice()}}</h2>
                    </div>
                </a>
            @endforeach
        </main>
        {{$postPaginator->links('partials.pagination')}}
    </div>

</div>
@endsection
