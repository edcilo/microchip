{{ Form::open(['route'=>['support.discard', $product->id]]) }}

<button type="submit" class="btn-red form_confirm" data-confirm="discard_product">
    <i class="fa fa-trash"></i>
    Desechar producto
</button>

{{ Form::close() }}

<div class="confirm-dialog hide" title="Desechar producto" id="discard_product" data-width="400">
    <div class="mesasge text-center">
        <p>¿Estas seguro de querer <strong>desechar</strong> el producto en soporte?</p>
    </div>
</div>