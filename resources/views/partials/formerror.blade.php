@error($name)
    <div class="my-2">
        @foreach($errors->get($name) as $error)
            <div class="py-1 px-2 my-1 bg-red-300 rounded-md">{{$error}}</div>
        @endforeach
    </div>
@enderror
