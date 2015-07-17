<div class="text-center">

    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Cerrar corte
    </button>

</div>

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('time_init', $time_init) }}
{{ Form::hidden('date_end', $date_end) }}
{{ Form::hidden('time_end', $time_end) }}

