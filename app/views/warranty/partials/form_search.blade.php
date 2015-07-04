{{ Form::open(['route'=>'warranty.search', 'method'=>'get', 'role'=>'form', 'class' => 'form fl-right', 'id'=>'form-search']) }}
{{ Form::text('terms', null, ['placeholder' => 'Buscar garantía', 'class'=>'search', 'autocomplete'=>'off']) }}
<button class="btn-search" type="submit"><span>Buscar</span></button>
{{ Form::close() }}
<div class="cont-form-search">
    <div class="search_general resultSearch globe-center hide" data-url="{{ asset('category') }}"></div>
</div>
