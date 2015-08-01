{{ Form::open(['route'=>['purchase.products.edit', $purchase->id], 'class'=>'inline']) }}

<button type="submit" class="btn-yellow">
    <i class="fa fa-pencil"></i>
    Modificar productos de la compra
</button>

{{ Form::close() }}