@extends('layouts.app')

@section('title', "login")

@section('content')

<main class="m-auto mt-4 max-w-xl">
    <div class="card">
        <h1 class="text-2xl font-bold text-left">Sign In</h1>
        <h2 class="mb-2 text-neutral-700">Fill in your username and password to sign into eBa... ehm.. "marktplaats" :)</h2>
        <form action="{{route('login')}}" method="POST">
            @include('partials.forminput', ['name' => 'name'])
            @include('partials.forminput', ['type' => 'password', 'name' => 'password'])
            @csrf
            <div class="flex gap-2 mt-4 justify-end-safe">
                <a class="button" href="{{route('register')}}">I don't have an account yet...</a>
                <button type="submit" class="button">Sign In</button>
            </div>
        </form>
    </div>
</main>

@endsection
