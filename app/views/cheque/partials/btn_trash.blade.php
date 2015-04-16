@if( p(14) )
    <a class="btn-red btn-recycle" title="Enviar a la papelera" href="#" data-id="{{ $cheque->id }}" data-name="{{ $cheque->folio }}">
        <i class="fa fa-trash"></i>
    </a>
@endif