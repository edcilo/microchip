{{ Form::open(['class'=>'form']) }}

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('date_end', $date_end) }}

<div class="col col100">

    <div class="flo col50 left">
        {{ Form::checkbox('save', 1, 1, ['id'=>'save']) }}
        {{ Form::label('save', 'Guardar retiro de caja') }}
    </div>

    <div class="flo col50 right text-right">

        <button type="submit" class="btn-green">
            <i class="fa fa-save"></i>
            Guardar corte
        </button>

    </div>

</div>

{{ Form::close() }}