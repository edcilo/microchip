{{ Form::open(['route'=>'concept.search', 'method'=>'get', 'role'=>'form', 'class' => 'form fl-right', 'id'=>'form-search']) }}
{{ Form::text('terms', null, ['placeholder' => 'Buscar concepto', 'class'=>'search', 'autocomplete'=>'off']) }}
<button class="btn-search" type="submit"><span>Buscar</span></button>
{{ Form::close() }}
