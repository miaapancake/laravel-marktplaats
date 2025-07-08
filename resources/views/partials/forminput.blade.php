<label for="{{$name}}">{{ucfirst(str_replace('_', ' ', $name))}}</label>
@if(isset($type) && $type == 'textarea')
    <textarea
        id="{{$name}}"
        name="{{$name}}"
        class="input @error($name) border-red-400 @enderror"
    >{{old($name) ?? $value ?? ''}}</textarea>
@elseif(isset($type) && $type == 'price')
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
@elseif(isset($type) && $type == 'select')
    <select
        id="{{$name}}"
        name="{{$name}}_id"
        class="input @error($name) border-red-400 @enderror"
    >
        @foreach($items as $item)
            <option
                value="{{$item->id}}"
                @if(isset($selected) && $selected == $item->id)
                    selected
                @endif
            >
                {{$item->name}}
            </option>
        @endforeach
    </select>
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


