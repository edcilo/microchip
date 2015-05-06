@if( p(78) )

    {{ Form::model($sale, ['route'=>['sale.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

    <div class="row flo col40 left">
        {{ Form::label('type', 'Tipo de documento: ') }}
        {{ Form::select('type', $type_list, null, ['data-required'=>'required', 'autofocus', 'title'=>'Seleccione un campo valido de la lista.']) }}
        <div class="message-error">
            {{ $errors->first('type', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col40 center">
        {{ Form::label('customer_id', 'Cliente: ') }}
        {{ Form::text('customer_id', null, ['data-required'=>'required', 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('customer_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 right text-right">
        <button type="submit" class="btn-green">
            <i class="fa fa-save"></i>
            Guardar y continuar
        </button>
    </div>

    {{ Form::close() }}

@endif
