{{ Form::open(['route'=>['purchase.save', $purchase->id], 'method'=>'post', 'class'=>'form validate', 'files'=>'true']) }}

<div class="row">
    {{ Form::label('bill_scan', 'Factura escaneada (PDF, RAR o ZIP):') }}
    {{ Form::file('bill_scan', ['title'=>'Este campo solo acepta archivo de tipo (pdf, rar, zip).', 'data-mimes'=>'pdf,rar,zip']) }}
    <div class="message-error">
        {{ $errors->first('bill_scan', '<span>:message</span>') }}
    </div>
</div>

<hr/>

<div class="row text-center">
    {{ Form::submit('Adjuntar archivo') }}
</div>

{{ Form::close() }}
