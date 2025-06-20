@extends('layouts.app')

@section('title', "Reset Password")

@section('content')

<main class="m-auto mt-4 max-w-xl">
    <div class="card">
        <h1 class="text-2xl font-bold text-left">Reset my password</h1>
        <h2 class="mb-4">
            Please enter a new password for your account!
        </h2>
        <form action="{{route('password.update')}}" method="post">
            <label for="email">Email</label>
            <input id="email" class="input" type="email" value="{{$email}}" disabled />
            <input name="email" type="hidden" value="{{$email}}" />
            @include('partials.formerror', ['name' => 'email'])

            @include('partials.forminput', ['name' => 'password', 'type' => 'password'])
            @include('partials.forminput', ['name' => 'password_confirmation', 'type' => 'password'])

            <input name="token" type="hidden" value="{{$token}}" />

            <div class="flex justify-end mt-4">
                <button class="button">Submit</button>
            </div>
            @csrf
        </form>
    </div>
</main>


@endsection
