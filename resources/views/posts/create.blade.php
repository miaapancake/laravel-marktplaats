@extends('layouts.app')

@section('title', "Create a new advertisement")

@section('content')
    <main class="m-4 mx-auto max-w-xl card">
        <h1 class="text-xl font-bold">Create a new advertisement</h1>
        <form method="POST" action="{{route('posts.store')}}">
            @include('partials.forminput', ['name' => 'title'])
            @include('partials.forminput', ['name' => 'description', 'type' => 'textarea'])

            @include('partials.forminput', ['name' => 'price', 'type' => 'number'])

            @csrf

            <div class="flex justify-end mt-4">
                <button class="button">Create Advertisement</button>
            </div>
        </form>
    </main>
@endsection
