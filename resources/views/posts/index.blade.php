@extends('layouts.app')

@section('content')
<div class="grid gap-4 p-4 m-auto my-4 max-w-7xl grid-cols-[300px_auto]">
    <div class="card">
        <h1 class="mb-4 font-semibold">Categories</h1>
        @include('partials.categories.menu', ['category' => isset($category) ? $category : null])
    </div>
    <div>
        <main class="grid grid-cols-4 gap-4 max-sm:grid-cols-1 max-md:grid-cols-2 max-lg:grid-cols-3">
            @foreach($postPaginator as $post)
                <a href="{{route('posts.show', $post->id)}}">
                    <div class="flex flex-col justify-between h-full hover:shadow-lg card">
                        <h1 class="mb-4">
                            @if($post->premium)
                                <span class="inline p-1 bg-blue-300 rounded-md">Premium</span>
                            @endif
                            <span>{{$post->title}}</span>
                        </h1>
                        <h2 class="text-lg font-bold text-neutral-800">{{$post->displayPrice()}}</h2>
                    </div>
                </a>
            @endforeach
        </main>
        {{$postPaginator->links('partials.pagination')}}
    </div>

</div>
@endsection
