<label for="{{$name}}">{{ucfirst(str_replace('_', ' ', $name))}}</label>
@if(isset($type) && $type == 'textarea')
    <textarea
        id="{{$name}}"
        name="{{$name}}"
        class="input @error($name) border-red-400 @enderror"
    >{{old($name) ?? $value ?? ''}}</textarea>

@elseif($name == 'price')
    <div class="flex max-w-32">
        <div class="flex justify-center items-center rounded-r-none border-r-0 size-8 input">
            €
        </div>
        <input
            id="{{$name}}"
            name="{{$name}}"
            class="rounded-l-none h-8 input @error($name) border-red-400 @enderror"
            type="number"
            value="{{old($name) ?? $value ?? ''}}"
            step="0.01"
            placeholder="0.00"
        />
    </div>
@else
    <input
        id="{{$name}}"
        name="{{$name}}"
        class="input @error($name) border-red-400 @enderror"
        type="{{$type ?? 'text'}}"
        value="{{old($name) ?? $value ?? ''}}"
    />
@endif
@include('partials.formerror', ['name' => $name])


