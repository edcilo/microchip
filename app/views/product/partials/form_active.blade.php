@if( p(58) AND ! $product->active )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Devolver de papelera a {{ $product->barcode }}</h3>

        {{ Form::open(['route' => ['product.restore', $product->id], 'method' => 'get', 'class' => 'form']) }}
        {{ Form::open(['route' => ['product.soft.delete', $product->id], 'method' => 'get', 'class' => 'form']) }}
        <div class="row text-center">
            <button type="submit" class="btn-green form_confirm" data-confirm="active_confirm">
                <i class="fa fa-arrow-up"></i>
                Devolver de papelera
            </button>
        </div>
        {{ Form::close() }}

        <div class="confirm-dialog hide" title="Papelera" id="active_confirm" data-width="400">
            <div class="mesasge text-center">
                <p>¿Estas seguro de querer recuperar de la papelera al producto <strong>{{ $product->barcode }}</strong>?</p>
            </div>
        </div>

    </div>
@endif
