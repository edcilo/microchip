@if( p(65) )

    <a class="btn-blue openDialog" title="Agregar monedero electronico." href="{{ route('customer.card.edit', [$customer->id]) }}">
        <i class="fa fa-credit-card"></i>
    </a>

    @endif