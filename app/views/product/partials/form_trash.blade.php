@if( p(57) AND $product->active )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Enviar a la papelera a {{ $product->barcode }}</h3>

        {{ Form::open(['route' => ['product.soft.delete', $product->id], 'method' => 'get', 'class' => 'form']) }}
        <div class="row text-center">
            <button class="btn-red"><i class="fa fa-trash"></i> Enviar a papelera</button>
        </div>
        {{ Form::close() }}

    </div>
@endif