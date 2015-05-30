{{ Form::open(['route'=>['report.utility.update', $report->id], 'method'=>'put']) }}

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('date_end', $date_end) }}

<div class="text-right">
    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar cambios
    </button>
</div>

{{ Form::close() }}