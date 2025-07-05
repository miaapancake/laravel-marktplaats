<nav aria-label="Category Navigation">
    @if($category && $category->parent)
        <a class="py-1 hover:underline" href="{{route('categories.show', $category->parent->id)}}">
            <div>{{$category->parent->name}}</div>
        </a>
        <div class="pl-2">
            @foreach($category->parent->categories as $sibblingCategory)
                <a href="{{route('categories.show', $sibblingCategory->id)}}">
                    <div
                        @if($sibblingCategory->id == $category->id)
                            aria-selected="true"
                        @endif
                        class="py-1 hover:underline aria-selected:font-bold"
                    >
                        {{$sibblingCategory->name}}
                    </div>
                </a>
                @if($sibblingCategory->id == $category->id)
                    <div class="pl-2">
                        @foreach($sibblingCategory->categories as $subcategory)
                            <a href="{{route('categories.show', $subcategory->id)}}">
                                <div class="py-1 hover:underline">{{$subcategory->name}}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endforeach
        <div class="pl-2">
    @elseif($category)
        <a class="py-1 font-bold hover:underline" href="{{route('categories.show', $category->id)}}">
            <div>{{$category->name}}</div>
        </a>
        <div class="pl-2">
            @foreach($category->categories as $subcategory)
                <a href="{{route('categories.show', $subcategory->id)}}">
                    <div class="py-1 hover:underline">{{$subcategory->name}}</div>
                </a>
            @endforeach
        </div>
    @else
        @foreach(\App\Models\Category::topLevelCategories()->get() as $category)
            <a class="py-1 hover:underline" href="{{route('categories.show', $category->id)}}">
                <div>{{$category->name}}</div>
            </a>
            <div class="pl-2">
                @foreach($category->categories as $subcategory)
                    <a href="{{route('categories.show', $subcategory->id)}}">
                        <div class="py-1 hover:underline">{{$subcategory->name}}</div>
                    </a>
                @endforeach
            </div>
        @endforeach
    @endif
</nav>
