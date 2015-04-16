<div class="row flo col50 left">

    <div class="col col100">
        <div class="row flo col50 left">

            {{ Form::label('equipment', 'Equipo:') }}
            {{ Form::text('equipment', null, ['class'=>'xb-input', 'autofocus', 'data-required'=>'required'])}}
            <div class="message-error">
                {{ $errors->first('details', '<span>:message</span>') }}
            </div>

            {{ Form::label('mark', 'Marca:') }}
            {{ Form::text('mark', null, ['class'=>'xb-input', 'data-required'=>'required'])}}
            <div class="message-error">
                {{ $errors->first('mark', '<span>:message</span>') }}
            </div>

        </div>

        <div class="row flo col50 right">

            {{ Form::label('model', 'Modelo:') }}
            {{ Form::text('model', null, ['class'=>'xb-input'])}}
            <div class="message-error">
                {{ $errors->first('model', '<span>:message</span>') }}
            </div>

            {{ Form::label('series', 'Número de serie:') }}
            {{ Form::text('series', null, ['class'=>'xb-input'])}}
            <div class="message-error">
                {{ $errors->first('series', '<span>:message</span>') }}
            </div>

        </div>
    </div>

    {{ Form::label('details', 'Detalles del equipo (contraseñas, accesorios, estado físico, etc.):') }}
    {{ Form::textarea('details', null, ['class'=>'xb-input', 'rows'=>2, 'data-required'=>'required']) }}

    <div class="message-error">
        {{ $errors->first('details', '<span>:message</span>') }}
    </div>

</div>

<div class="row flo col50 right">

    <div class="row">
        {{ Form::label('observations', 'Fallos y/o observaciones:') }}
        {{ Form::textarea('observations', null, ['class'=>'xb-input', 'rows'=>3, 'data-required'=>'required']) }}

        <div class="message-error">
            {{ $errors->first('observations', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        {{ Form::label('internal', 'Observaciones internas:') }}
        {{ Form::textarea('internal', null, ['class'=>'xb-input', 'rows'=>3]) }}

        <div class="message-error">
            {{ $errors->first('internal', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100 text-right">
    <div class="row">
        {{ Form::label('warranty_id', 'Folio de venta (Garantía):') }}
        {{ Form::text('warranty_id'); }}
        <div class="message-error">
            {{ $errors->first('warranty_id', '<span>:message</span>') }}
        </div>
    </div>
</div>


<div class="col col100 text-right">

    <div class="message-error">
        {{ $errors->first('sale_id', '<span>:message</span>') }}
    </div>

    <hr/>

    <button type="submit" class="btn-green">
        <i class="fa fa-arrow-right"></i>
        Siguiente
    </button>

</div>

{{ Form::close() }}