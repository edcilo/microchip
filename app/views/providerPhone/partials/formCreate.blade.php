    {{ Form::hidden('provider_id', $provider->id) }}

    <div class="flo col60 row left">
        {{ Form::text('phone', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'autofocus']) }}
        <div class="message-error">
            {{ $errors->first('phone', '<span>:message</span>') }}
        </div>
    </div>



    <div class="flo col40 row">

        <div class="flo col50 text-center">
            <button type="submit" class="btn-green">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>

        <div class="flo col50 text-center">
            <a href="{{ route('provider.show', [$provider->slug, $provider->id]) }}" class="btn-red" title="Cancelar">
                Cancelar
            </a>
        </div>

    </div>

{{ Form::close() }}