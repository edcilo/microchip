{{ Form::open(['route'=>'report.money.store', 'class'=>'form']) }}

<div class="text-center">

    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Cerrar corte
    </button>

</div>

{{ Form::hidden('date_init', $date_init) }}
{{ Form::hidden('date_end', $date_end) }}

{{ Form::hidden('quantity_1000', Input::get('quantity_1000')) }}
{{ Form::hidden('quantity_500', Input::get('quantity_500')) }}
{{ Form::hidden('quantity_200', Input::get('quantity_200')) }}
{{ Form::hidden('quantity_100', Input::get('quantity_100')) }}
{{ Form::hidden('quantity_50', Input::get('quantity_50')) }}
{{ Form::hidden('quantity_20', Input::get('quantity_20')) }}
{{ Form::hidden('quantity_10', Input::get('quantity_10')) }}
{{ Form::hidden('quantity_5', Input::get('quantity_5')) }}
{{ Form::hidden('quantity_2', Input::get('quantity_2')) }}
{{ Form::hidden('quantity_1', Input::get('quantity_1')) }}
{{ Form::hidden('quantity_05', Input::get('quantity_05')) }}

{{ Form::hidden('quantity_r_1000', Input::get('quantity_r_1000')) }}
{{ Form::hidden('quantity_r_500', Input::get('quantity_r_500')) }}
{{ Form::hidden('quantity_r_200', Input::get('quantity_r_200')) }}
{{ Form::hidden('quantity_r_100', Input::get('quantity_r_100')) }}
{{ Form::hidden('quantity_r_50', Input::get('quantity_r_50')) }}
{{ Form::hidden('quantity_r_20', Input::get('quantity_r_20')) }}
{{ Form::hidden('quantity_r_10', Input::get('quantity_r_10')) }}
{{ Form::hidden('quantity_r_5', Input::get('quantity_r_5')) }}
{{ Form::hidden('quantity_r_2', Input::get('quantity_r_2')) }}
{{ Form::hidden('quantity_r_1', Input::get('quantity_r_1')) }}
{{ Form::hidden('quantity_r_05', Input::get('quantity_r_05')) }}

{{ Form::close() }}