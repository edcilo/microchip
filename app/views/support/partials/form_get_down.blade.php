{{ Form::open(['route'=>['support.get.down', $product->id], 'class'=>'form validate']) }}

@include('support.partials.form_authorization')

<button type="submit" class="btn-blue form_confirm" data-confirm="get_down_product">
    <i class="fa fa-arrow-down"></i>
    Devolver producto
</button>

{{ Form::close() }}

<div class="confirm-dialog hide" title="Devolver producto" id="get_down_product" data-width="400">
    <div class="mesasge text-center">
        <p>¿Estas seguro de querer devolver el producto {{ $product->product->barcode }}?</p>
    </div>
</div>