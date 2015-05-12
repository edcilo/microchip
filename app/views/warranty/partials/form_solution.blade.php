{{ Form::model($warranty, ['route' => ['warranty.save.solution', $warranty->id], 'method'=>'put', 'class'=>'form validate']) }}

<div class="row">
    {{ Form::label('solution', 'Solución de garantía:', ['class' => 'label50 text-right']) }}
    {{ Form::select('solution', trans('lists.warranty_solutions')) }}
    <div class="message-error">
        {{ $errors->first('solution', '<span>:message</span>') }}
    </div>
</div>

<div class="row">
    {{ Form::label('ns', 'Número de serie:', ['class' => 'label50 text-right']) }}
    {{ Form::text('ns') }}
    <div class="message-error">
        {{ $errors->first('ns', '<span>:message</span>') }}
    </div>
</div>

<div class="row text-center">
    <button class="btn-green" type="submit">
        <i class="fa fa-save"></i>
        Guardar solución
    </button>
</div>

{{ Form::close() }}