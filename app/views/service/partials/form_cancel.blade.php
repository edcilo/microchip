@if( p(104) AND ( $sale->status == 'Emitido'))

    {{ Form::open(['route'=>['service.cancel', $sale->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red">
        <i class="fa fa-ban"></i>
        Cancelar servicio
    </button>

    {{ Form::close() }}

@else

    &nbsp;

@endif