@if( p(104) AND ( $sale->status == 'Emitido' OR $sale->status == 'Pagado'))

    {{ Form::open(['route'=>['service.cancel', $sale->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red form_confirm" data-confirm="cancel_confirm">
        <i class="fa fa-ban"></i>
        Cancelar servicio
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Cancelar pedido" id="cancel_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer cancelar el servicio {{ $sale->folio }}?</h3>
        </div>
    </div>

@else

    &nbsp;

@endif
