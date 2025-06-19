<label for="{{$name}}">{{ucfirst(str_replace('_', ' ', $name))}}</label>
<input
    id="{{$name}}"
    name="{{$name}}"
    class="input @error($name) border-red-400 @enderror"
    type="{{$type ?? 'text'}}"
    value="{{old($name)}}"
/>
@include('partials.formerror', ['name' => $name])


