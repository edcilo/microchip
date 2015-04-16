<div class="col col100">
    <fieldset>
        <legend>Datos de usuario</legend>

        <div class="row flo col33 left">
            {{ Form::label('department_id', 'Departamento: ', ['class'=>'label50']) }} <br/>
            {{ Form::select('department_id', $department_list, null, ['autofocus', 'title'=>'Elija una opción valida de la lista', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('department_id', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col33 center">
            {{ Form::label('username', 'Nombre de usuario: ', ['class'=>'label50']) }} <br/>
            {{ Form::text('username', null, ['title'=>'Este campo es obligatorio', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('username', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col33 right">
            {{ Form::label('password', 'Contraseña: ', ['class'=>'label50']) }} <br/>
            {{ Form::text('password', '', ['title'=>'Este campo es obligatorio y debe tener al menos 8 caracteres.', 'data-min'=>'8']) }}
            <button class="btn-green key-gen" type="button" title="Generar contraseña"><i class="fa fa-key"></i></button>
            <div class="message-error">
                {{ $errors->first('password', '<span>:message</span>') }}
            </div>
            @if ( Session::get('bad_password') )
                <div class="message-error">{{ Session::get('bad_password') }}</div>
            @endif
        </div>
    </fieldset>
</div>