@if($warranty->status == 'Pendiente' AND p(122))

    {{ Form::open(['route'=>['warranty.send', $warranty->id], 'class'=>'inline']) }}

    <button type="submit" class="btn-green" title="Enviar producto a garantía">
        <i class="fa fa-truck"></i>
    </button>

    {{ Form::close() }}

@endif