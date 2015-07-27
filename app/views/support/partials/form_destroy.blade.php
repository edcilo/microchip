{{ Form::open(['route'=>['support.destroy', $product->id], 'class'=>'form', 'method'=>'delete']) }}

<button type="submit" class="btn-red form_confirm" data-confirm="destroy_product">
    <i class="fa fa-times"></i>
    Eliminar
</button>

{{ Form::close() }}

<div class="confirm-dialog hide" title="Eliminar producto" id="destroy_product" data-width="400">
    <div class="mesasge text-center">
        <p>¿Estas seguro de querer eliminar producto en soporte?</p>
    </div>
</div>