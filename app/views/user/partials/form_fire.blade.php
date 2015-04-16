{{ Form::open(['route' => ['user.down'], 'method' => 'POST', 'class' => 'form validate']) }}
{{ Form::hidden('id', $user->id) }}

<div class="row">
    {{ Form::label('fired', 'Fecha de despido:', ['class'=>'label50']) }}
    {{ Form::text('fired', date('Y-m-d'), ['title'=>'Este campo es obligatorio y debe tener el siguiente formato de fecha [AAAA-MM-DD]', 'data-required'=>'required', 'data-date'=>'date']) }}
    <div class="message-error">
    {{ $errors->first('fired', '<span>:message</span') }}
    </div>
</div>

<div class="row">
    {{ Form::label('reason', 'Razón de despido:', ['class'=>'label50']) }}
    {{ Form::textarea('reason', $user->profile->reason, ['rows'=>'4', 'title'=>'Este campo acepta hasta 1020 caracteres', 'data-max'=>'1020']) }}
    <div class="message-error">
        {{ $errors->first('reason', '<span>:message</span>') }}
    </div>
</div>

<hr/>
<div class="row text-right">
    <button class="btn-red" type="submit"><i class="fa fa-arrow-down"></i> Despedir</button>
</div>

{{ Form::close() }}