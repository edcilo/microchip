{{ Form::open(['route'=>'purchase.search', 'method'=>'get', 'role'=>'form', 'class' => 'form fl-right', 'id'=>'form-search']) }}
{{ Form::text('terms', null, ['placeholder' => 'Buscar factura de compra', 'class'=>'search', 'autocomplete'=>'off']) }}
<button class="btn-search" type="submit"><span>Buscar</span></button>
{{ Form::close() }}
<div class="cont-form-search">
    <div class="resultSearch globe-center hide" data-url="{{ asset('purchase') }}"></div>
</div>