@if ( p(44) AND !count($mark->products) )
    <hr/>

    {{ Form::open(['route'=>['mark.destroy', $mark->id], 'method'=>'delete', 'class'=>'form']) }}
    <div class="row text-right">
        <button class="btn-red form_confirm">
            <i class="fa fa-times"></i> Eliminar marca
        </button>
    </div>
    {{ Form::close() }}


    <div class="confirm-dialog hide" title="Eliminar marca" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar la marca <strong>{{ $mark->name }}</strong>?</p>
        </div>
    </div>
@endif
