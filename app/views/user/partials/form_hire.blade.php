{{ Form::open(['route' => ['user.up'], 'method' => 'POST', 'class' => 'form validate']) }}
{{ Form::hidden('id', $user->id) }}

<div class="row">
    {{ Form::label('hired', 'Fecha de recontrato:', ['class'=>'label50']) }}
    {{ Form::text('hired', date('Y-m-d'), ['title'=>'Este campo es obligatorio y debe tener el siguiente formato de fecha [AAAA-MM-DD]', 'data-required'=>'required', 'data-date'=>'date']) }}
    <div class="message-error">
    {{ $errors->first('hired', '<span>:message</span') }}
    </div>
</div>

<div class="row">
    {{ Form::label('observations', 'Observaciones del usuario:', ['class'=>'label50']) }}
    {{ Form::textarea('observations', $user->profile->observations, ['rows'=>'4', 'title'=>'Este campo acepta hasta 1020 caracteres', 'data-max'=>'1020']) }}
    <div class="message-error">
        {{ $errors->first('observations', '<span>:message</span>') }}
    </div>
</div>

<hr/>
<div class="row text-right">
    <button class="btn-green" type="submit"><i class="fa fa-arrow-up"></i> Recontratar</button>
</div>

{{ Form::close() }}