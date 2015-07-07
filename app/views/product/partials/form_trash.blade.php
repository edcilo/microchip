@if( p(57) AND $product->active )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Enviar a la papelera a {{ $product->barcode }}</h3>

        {{ Form::open(['route' => ['product.soft.delete', $product->id], 'method' => 'get', 'class' => 'form']) }}
        <div class="row text-center">
            <button type="submit" class="btn-red form_confirm" data-confirm="trash_confirm">
                <i class="fa fa-trash"></i>
                Enviar a papelera
            </button>
        </div>
        {{ Form::close() }}

        <div class="confirm-dialog hide" title="Papelera" id="trash_confirm" data-width="400">
            <div class="mesasge text-center">
                <p>¿Estas seguro de querer enviar a la papelera al producto <strong>{{ $product->barcode }}</strong>?</p>
            </div>
        </div>

    </div>
@endif
