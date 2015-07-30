@if(!$purchase->progress_5)

    {{ Form::open(['route' => ['purchase.check.prices', $purchase->id], 'class'=>'inline']) }}

    <button type="submit" class="btn-green form_confirm" data-confirm="check_prices">
        <i class="fa fa-check"></i>
        Precios de productos revisados
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Marcar precios de productos revisados" id="check_prices" data-width="400">
        <div class="mesasge text-center">
            <p>
                ¿Estas seguro de querer marcar los precios de los productos como revisados?
            </p>
        </div>
    </div>
@endif