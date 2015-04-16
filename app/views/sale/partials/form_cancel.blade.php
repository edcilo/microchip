@if( p(82) AND ( $sale->status == 'Emitido' OR $sale->status == 'Pagado' ))

    {{ Form::open(['route'=>['sale.cancel', $sale->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red">
        <i class="fa fa-ban"></i>
        Cancelar venta
    </button>

    {{ Form::close() }}

@endif