@if( p(82) AND ( $sale->status == 'Emitido' OR $sale->status == 'Pagado' ))

    {{ Form::open(['route'=>['sale.cancel', $sale->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red form_confirm" data-confirm="cancel_confirm">
        <i class="fa fa-ban"></i>
        Cancelar venta
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Cancelar venta" id="cancel_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer cancelar la venta {{ $sale->folio }}?</h3>
        </div>
    </div>

@endif
