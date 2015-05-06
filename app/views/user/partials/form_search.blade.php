{{ Form::open(['route'=>'user.search', 'method'=>'get', 'role'=>'form', 'class' => 'form fl-right', 'id'=>'form-search']) }}
{{ Form::text('terms', null, ['placeholder' => 'Buscar empleado', 'class'=>'search', 'autocomplete'=>'off']) }}
<button class="btn-search" type="submit"><span>buscar</span></button>
{{ Form::close() }}
<div class="cont-form-search">
    <div class="resultSearch globe-center hide" data-url="{{ asset('user') }}"></div>
</div>
