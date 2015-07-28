{{ Form::open(['route'=>'support.index', 'method'=>'get', 'class'=>'form validate']) }}

{{ Form::label('status', 'Ver:') }}
{{ Form::select('status', [
    null => 'Todo',
    'Devuelto' => 'Devuelto',
    'Gasto' => 'Gasto',
    'Prestamo' => 'Prestamo',
    'Uso' => 'Uso',
    ], $status) }}

<button type="submit" class="btn-blue" title="Filtrar">
    <i class="fa fa-filter"></i>
</button>

{{ Form::close() }}