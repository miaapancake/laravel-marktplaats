@extends('layouts.app')

@section('title', "register")

@section('content')

<main class="m-auto mt-4 max-w-xl">
    <div class="card">
        <h1 class="text-2xl font-bold text-left">Register</h1>
        <h2 class="mb-2 text-neutral-700">Fill in the form to create your new account!</h2>
        <form action="{{route('register')}}" method="POST">
            @include('partials.forminput', ['name' => 'name'])
            @include('partials.forminput', ['name' => 'email', 'type' => 'email'])
            @include('partials.forminput', ['type' => 'password', 'name' => 'password'])
            @include('partials.forminput', ['type' => 'password', 'name' => 'password_confirmation'])
            @csrf
            <div class="flex gap-2 mt-4 justify-end-safe">
                <a class="button" href="{{route('login')}}">I already have an account!</a>
                <button type="submit" class="button">Sign Up</button>
            </div>
        </form>
    </div>
</main>

@endsection
