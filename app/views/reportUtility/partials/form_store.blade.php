{{ Form::open(['route'=>'report.utility.store', 'method'=>'post']) }}

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('date_end', $date_end) }}

<div class="text-right">
    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar reporte
    </button>
</div>

{{ Form::close() }}