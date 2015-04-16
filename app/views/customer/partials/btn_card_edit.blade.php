@if( p(65) )

    <a class="btn-yellow float-right openDialog" title="Modificar monedero electronico." href="{{ route('customer.card.edit', [$customer->id]) }}">
        <i class="fa fa-credit-card"></i>
    </a>

    @endif