@if( p(47) )

    <a class="btn-yellow" href="{{ route('category.edit', [$category->slug, $category->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif