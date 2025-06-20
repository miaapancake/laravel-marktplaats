@extends('layouts.app')

@section('title', "I forgor")

@section('content')

<main class="m-auto mt-4 max-w-xl">
    <div class="card">
        <h1 class="text-2xl font-bold text-left">Forgot my password</h1>
        @if(session('status'))
            <h2 class="p-4 mt-4 bg-green-300 rounded-md">{{session('status')}}</h2>
        @else
            <h2 class="mb-4">
                Please enter the email you used for your account here.
                We'll send you a code to reset your password if it matches an account.
            </h2>
            <form action="{{route('password.request')}}" method="post">
                @include('partials.forminput', ['name' => 'email', 'type' => 'email'])
                <div class="flex justify-end mt-4">
                    <button class="button">Submit</button>
                </div>
                @csrf
            </form>
        @endif
    </div>
</main>


@endsection
