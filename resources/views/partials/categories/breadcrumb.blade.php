@php($currentCategory = $category)

<div class="flex flex-row-reverse flex-wrap-reverse gap-2 justify-end">
@while($currentCategory != null)
    <span>&gt;</span>
    <a class="opacity-50 hover:underline hover:opacity-100" href="{{route('categories.show', $currentCategory->id)}}">
        <span class="whitespace-nowrap">{{$currentCategory->name}}</span>
    </a>
    @php($currentCategory = $currentCategory->parent)
@endwhile
</div>

