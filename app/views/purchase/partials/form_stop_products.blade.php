@if( p(61) )

    {{ Form::open(['route'=>['purchase.stop', $purchase->id], 'method'=>'get']) }}
    <button type="submit" class="btn-green form_confirm" data-confirm="stop_products_confirm">
        <i class="fa fa-ban"></i>
        Terminar captura de productos
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Terminar captura de productos" id="stop_products_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>
                ¿Estas seguro de haber terminado el alta de productos?
                <strong>Una vez realizada esta acción ya no se podra deshacer</strong>.
            </p>
        </div>
    </div>

@endif
