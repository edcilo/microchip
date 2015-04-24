@if( p(92) AND $sale->status != 'Cancelado' )

    {{ Form::open(['route'=>['comment.store', $sale->id], 'method'=>'post', 'class'=>'form validate']) }}

    <div class="row">
        {{ Form::textarea('comment', null, ['class'=>'xb-input', 'placeholder'=>'Escribe tu reporte', 'rows'=>3, 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('comment', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row text-right">

        <button type="submit" class="btn-green">
            <i class="fa fa-book"></i>
            Agregar a la bitácora.
        </button>

    </div>

    {{ Form::close() }}

@endif