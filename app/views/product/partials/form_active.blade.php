@if( p(58) AND ! $product->active )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Devolver de papelera a {{ $product->barcode }}</h3>

        {{ Form::open(['route' => ['product.restore', $product->id], 'method' => 'get', 'class' => 'form']) }}
        {{ Form::open(['route' => ['product.soft.delete', $product->id], 'method' => 'get', 'class' => 'form']) }}
        <div class="row text-center">
            <button class="btn-green"><i class="fa fa-arrow-up"></i> Devolver de papelera</button>
        </div>
        {{ Form::close() }}

    </div>
@endif