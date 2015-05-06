@if( p(37) )

    <a class="btn-yellow" href="{{ route('provider.edit', [$provider->slug, $provider->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif
