@if ( p(48) AND ! count($category->products) )
    <hr/>

    {{ Form::open(['route'=>['category.destroy', $category->id], 'method'=>'delete', 'class'=>'form']) }}
    <div class="row text-right">
        <button class="btn-red"><i class="fa fa-times"></i> Eliminar categoría</button>
    </div>
    {{ Form::close() }}
@endif
