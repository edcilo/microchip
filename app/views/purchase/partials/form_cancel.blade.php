{{ Form::open(['route'=>['purchase.cancel', $purchase->id], 'method'=>'delete']) }}

<button type="submit" class="btn-red form_confirm" data-confirm="purchase_cancel_confirm">
    <i class="fa fa-ban"></i>
    Cancelar compra
</button>

{{ Form::close() }}

<div class="confirm-dialog hide" title="Cancelar compra" id="purchase_cancel_confirm" data-width="400">
    <div class="mesasge text-center">
        <p>
            ¿Estas seguro de querer cancelar la compra <strong>{{ $purchase->folio }}</strong>?
            <br>
            <strong>
                Se eliminaran todos los movimientos de inventario y
                los registros de pagos
            </strong>
        </p>
    </div>
</div>