<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Marktplaats</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js" integrity="sha384-Akqfrbj/HpNVo8k11SXBb6TlBWmXXlYQrCSqEWmyKJe+hDm3Z/B2WVG4smwBkRVm" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-neutral-200">
    <div class="h-32"></div>
    <nav class="fixed top-0 z-50 w-full h-32 bg-neutral-100">
        <div class="max-w-4xl nav-items">
            <div class="justify-start nav-items-left">
                <a href="{{route('welcome')}}">
                    <div class="nav-item">
                        <img class="py-3 h-full" src="/logo.svg"></img>
                    </div>
                </a>
            </div>
            <div class="justify-end nav-items-right">
                @if(Auth::user())
                    <a href="{{route('chats.index')}}">
                        <div class="nav-item">
                            <i data-lucide="message-circle"></i>
                            <span>Messages</span>
                        </div>
                    </a>
                    <a href="{{route('dashboard')}}">
                        <div class="nav-item">
                            <i data-lucide="user"></i>
                            <span>{{Auth::user()->name}}</span>
                        </div>
                    </a>
                    <a href="{{route('logout')}}">
                        <div class="nav-item">
                            <i data-lucide="log-out"></i>
                            <span>Sign Out</span>
                        </div>
                    </a>
                @else
                    <a href="/login">
                        <div class="nav-item">
                            <i data-lucide="log-in"></i>
                            <span>Sign In</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
        <div class="flex justify-center p-4 px-2 m-auto max-w-4xl">
            <form action="/search" class="w-full">
                <div class="flex items-stretch w-full h-10">
                    <input class="px-2 w-full rounded-l-md border-1 border-neutral-600" name="query"
                        placeholder="search..." type="text" value="{{ !empty(app('request')->input('query')) ? app('request')->input('query') : '' }}" />
                    <button
                        class="px-4 rounded-r-md border-l-0 cursor-pointer bg-neutral-100 border-1 border-neutral-600"
                        type="submit"
                    >
                         Search
                    </button>
                </div>
            </form>
        </div>
    </nav>
    @yield('content')
    @vite(['resources/js/app.js'])
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
