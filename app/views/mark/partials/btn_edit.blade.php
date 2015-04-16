@if( p(43) )

    <a class="btn-yellow" href="{{ route('mark.edit', [$mark->slug, $mark->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif