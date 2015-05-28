{{ Form::open(['route'=>['report.money.update', $report_money->id], 'method'=>'put', 'class'=>'form']) }}

<div class="text-center">

    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar cambios
    </button>

</div>

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('date_end', $date_end) }}

{{ Form::hidden('quantity_1000', $data['quantity_1000']) }}
{{ Form::hidden('quantity_500', $data['quantity_500']) }}
{{ Form::hidden('quantity_200', $data['quantity_200']) }}
{{ Form::hidden('quantity_100', $data['quantity_100']) }}
{{ Form::hidden('quantity_50', $data['quantity_50']) }}
{{ Form::hidden('quantity_20', $data['quantity_20']) }}
{{ Form::hidden('quantity_10', $data['quantity_10']) }}
{{ Form::hidden('quantity_5', $data['quantity_5']) }}
{{ Form::hidden('quantity_2', $data['quantity_2']) }}
{{ Form::hidden('quantity_1', $data['quantity_1']) }}
{{ Form::hidden('quantity_05', $data['quantity_05']) }}

{{ Form::hidden('quantity_r_1000', $data['quantity_r_1000']) }}
{{ Form::hidden('quantity_r_500', $data['quantity_r_500']) }}
{{ Form::hidden('quantity_r_200', $data['quantity_r_200']) }}
{{ Form::hidden('quantity_r_100', $data['quantity_r_100']) }}
{{ Form::hidden('quantity_r_50', $data['quantity_r_50']) }}
{{ Form::hidden('quantity_r_20', $data['quantity_r_20']) }}
{{ Form::hidden('quantity_r_10', $data['quantity_r_10']) }}
{{ Form::hidden('quantity_r_5', $data['quantity_r_5']) }}
{{ Form::hidden('quantity_r_2', $data['quantity_r_2']) }}
{{ Form::hidden('quantity_r_1', $data['quantity_r_1']) }}
{{ Form::hidden('quantity_r_05', $data['quantity_r_05']) }}

{{ Form::close() }}