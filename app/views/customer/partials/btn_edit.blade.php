@if( p(65) AND $customer->active )

    <a class="btn-yellow" href="{{ route('customer.edit', [$customer->slug, $customer->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif
