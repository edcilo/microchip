@if($purchase->progress_5)

    {{ Form::open(['route' => ['purchase.uncheck.prices', $purchase->id], 'method'=>'delete', 'class'=>'inline']) }}

    <button type="submit" class="btn-red form_confirm" data-confirm="uncheck_prices">
        <i class="fa fa-times"></i>
        Desmarcar precios de productos revisados
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Desmarcar revision de precios" id="uncheck_prices" data-width="400">
        <div class="mesasge text-center">
            <p>
                ¿Estas seguro de querer desmarcar los precios de productos revisados?
            </p>
        </div>
    </div>
@endif