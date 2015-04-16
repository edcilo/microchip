@if( p(59) AND !$product->active )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Eliminar {{ $product->type }}</h3>

        {{ Form::open(['route'=>['product.destroy', $product->id], 'method'=>'delete', 'class'=>'form']) }}
        <div class="row text-center">
            <button class="btn-red"><i class="fa fa-times"></i> Eliminar {{ $product->type }}</button>
        </div>
        {{ Form::close() }}

    </div>
@endif