@if ( p(48) AND ! count($category->products) )
    <hr/>

    {{ Form::open(['route'=>['category.destroy', $category->id], 'method'=>'delete', 'class'=>'form']) }}
    <div class="row text-right">
        <button class="btn-red form_confirm" data-confirm="destroy_confirm">
            <i class="fa fa-times"></i> Eliminar categoría
        </button>
    </div>
    {{ Form::close() }}


    <div class="confirm-dialog hide" title="Eliminar categoría" id="destroy_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar la categoría <strong>{{ $category->name }}</strong>?</p>
        </div>
    </div>
@endif
