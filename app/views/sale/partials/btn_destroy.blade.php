@if( p(81) AND $sale->status == 'Pendiente')

    <a class="btn-red btn-delete" href="#" data-id="{{ $sale->id }}" data-name="{{ $sale->folio }}" title="Eliminar partida">
        <i class="fa fa-times"></i>
    </a>

@endif