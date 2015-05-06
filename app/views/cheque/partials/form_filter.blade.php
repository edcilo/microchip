{{ Form::open(['route'=>'cheque.filter', 'method'=>'get', 'class'=>'form validate']) }}

{{ Form::hidden('bank_id', $bank->id) }}
{{ Form::select('status', $status_list, $data_strip['status'], []) }}

{{ Form::text('date_start', $data_strip['date_start'], ['placeholder'=>'Fecha inicial', 'data-date'=>'date']) }}
{{ Form::text('date_end', $data_strip['date_end'], ['placeholder'=>'Fecha final', 'data-date'=>'date']) }}

<button class="btn-green" type="submit"><i class="fa fa-filter"></i></button>

{{ Form::close() }}
